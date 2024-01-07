const mongoose = require("mongoose");
const Schema = mongoose.Schema;

const dataSchema = new Schema({
  title: {
    type: String,
    require: true,
  },
  body: {
    type: String,
    require: true,
  },
});

module.exports = mongoose.model("Data", dataSchema);
