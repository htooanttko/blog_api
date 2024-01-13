const User = require("../models/User");
const RoleList = require("../config/role_list");
const bcrypt = require("bcrypt");

const getAllUser = async (req, res) => {
  const result = await User.find();
  if (!result) return res.status(204).json({ message: "There is no user." });
  res.json(result);
};

const updateUser = async (req, res) => {
  if (!req.body.id)
    return res.status(400).json({ message: "User ID required" });

  try {
    const result = await User.findOne({ _id: req.body.id }).exec();

    if (!result) return res.status(204).json({ message: "User not Found" });
    if (req.body.username) result.username = req.body.username;
    if (req.body.role)
      result.role =
        req.body.role == RoleList.admin ? { admin: 5150 } : { user: 2001 };

    const data = await result.save();
    res.json(data);
  } catch (err) {
    res.sendStatus(500);
  }
};

const deleteUser = async (req, res) => {
  if (!req.body.id)
    return res.status(400).json({ message: "User ID required" });
  try {
    const result = await User.findOne({ _id: req.body.id }).exec();
    if (!result) return res.status(204).json({ message: "User not Found" });
    const data = await result.deleteOne();
    res.json(data);
  } catch (err) {
    res.sendStatus(500);
  }
};

const getUser = async (req, res) => {
  if (!req.params.id)
    return res.status(400).json({ message: "User ID required" });
  try {
    const result = await User.findOne({ _id: req.params.id }).exec();
    if (!result) return res.status(204).json({ message: "User not Found" });

    res.json(result);
  } catch (err) {
    res.sendStatus(500);
  }
};

const changePassword = async (req, res) => {
  if (!req.body.id)
    return res.status(400).json({ message: "User ID required" });
  if (!req.body.password)
    return res.status(400).json({ message: "New password is required" });

  try {
    const foundUser = await User.findOne({ _id: req.body.id }).exec();
    if (!foundUser) return res.status(204).json({ message: "User not Found" });

    const duplicate = await bcrypt.compare(
      req.body.password,
      foundUser.password
    );
    if (duplicate) return res.sendStatus(409);

    foundUser.password = await bcrypt.hash(req.body.password, 10);
    const result = await foundUser.save();

    res.json(result);
  } catch (err) {
    res.sendStatus(500);
  }
};
module.exports = {
  getAllUser,
  updateUser,
  deleteUser,
  getUser,
  changePassword,
};
