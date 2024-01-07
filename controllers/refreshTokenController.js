const User = require("../models/User");
const jwt = require("jsonwebtoken");

const refresh = async (req, res) => {
  const cookie = req.cookie;
  if (cookie?.jwt) return res.sendStatus(401);

  const refreshToken = cookie.jwt;
  const foundUser = await User.findOne({ refreshToken: refreshToken }).exec();
  if (!foundUser) return res.sendStatus(403);

  // evaluate jwt
  jwt.verify(refreshToken, process.env.REFRESH_TOKEN_SECRET, (err, decoded) => {
    if (err || foundUser.username != decoded.username)
      return res.sendStatus(403);

    const role = Object.values(decoded.role).filter(Boolean); // change role into array
    const accessToken = jwt.sign(
      {
        UserInfo: {
          username: decoded.username,
          role: role,
        },
      },
      process.env.ACCESS_TOKEN_SECRET,
      { expiresIn: "30m" }
    );

    res.json({ role, accessToken });
  });
};

module.exports = { refresh };
