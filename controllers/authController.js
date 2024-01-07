const User = require("../models/User");
const bcrypt = require("bcrypt");
const jwt = require("jsonwebtoken");

const createUser = async (req, res) => {
  const { username, password } = req.body;
  if (!username || !password)
    return res
      .status(400)
      .json({ message: "username and password are required." });

  const duplicate = await User.findOne({ username: username }).exec();
  if (duplicate) return res.sendStatus(409);

  try {
    const hashedPwd = await bcrypt.hash(password, 10);
    const result = await User.create({
      username: username,
      password: hashedPwd,
    });

    console.log(result);
    res.status(201).json({ message: "User created Successfully." });
  } catch (err) {
    res.status(500).json({ message: err.message });
  }
};

const loginUser = async (req, res) => {
  const { username, password } = req.body;
  if (!username || !password)
    return res
      .status(400)
      .json({ message: "username and password are required." });

  const foundUser = await User.findOne({ username: username }).exec();
  if (!foundUser) return res.sendStatus(401);

  if (!foundUser.role.user && !foundUser.role.admin)
    foundUser.role = { user: 2001 };

  const match = await bcrypt.compare(password, foundUser.password);
  if (match) {
    const role = Object.values(foundUser.role).filter(Boolean); // change role into array
    const accessToken = jwt.sign(
      {
        UserInfo: {
          username: foundUser.username,
          role: role,
        },
      },
      process.env.ACCESS_TOKEN_SECRET,
      { expiresIn: "30m" }
    );

    const refreshToken = jwt.sign(
      { username: foundUser.username },
      process.env.REFRESH_TOKEN_SECRET,
      { expiresIn: "30d" }
    );

    foundUser.refreshToken = refreshToken;
    const result = await foundUser.save();
    console.log(result);

    res.cookie("jwt", refreshToken, {
      httpOnly: true,
      secure: true,
      sameSite: "None",
      maxAge: 30 * 24 * 60 * 60 * 1000,
    });

    res.json({ accessToken, role });
  } else res.sendStatus(401);
};

const logoutUser = async (req, res) => {
  // also delete access token in client site

  const cookie = req.cookie;
  if (cookie?.jwt) return res.sendStatus(204);

  const refreshToken = cookie.jwt;
  const foundUser = await User.findOne({ refreshToken: refreshToken }).exec();
  if (!foundUser) {
    res.clearCookie("jwt", { httpOnly: true, sameSite: "None", secure: true });
    return res.sendStatus(204);
  }

  foundUser.refreshToken = "";
  const result = await foundUser.save();
  console.log(result);

  res.clearCookie("jwt", { httpOnly: true, sameSite: "None", secure: true });
  res.sendStatus(204);
};

module.exports = {
  createUser,
  loginUser,
  logoutUser,
};
