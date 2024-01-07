const mongoose = require("mongoose");
const Schema = mongoose.Schema;

const userSchema = new Schema({
  username: {
    type: String,
    require: true,
  },
  role: {
    user: Number,
    admin: Number,
  },
  password: {
    type: String,
    require: true,
  },
  refreshToken: String,
});

module.exports = mongoose.model("User", userSchema);
