const Data = require("../models/Data");

const getAllData = async (req, res) => {
  const datas = await Data.find();
  if (!datas) return res.status(204).json({ message: "No data found" });
  res.json(datas);
};

const addData = async (req, res) => {
  if (!req.body.title || !req.body.body) {
    return res.status(400).json({ message: "title and body are required." });
  }
  try {
    const result = await Data.create({
      title: req.body.title,
      body: req.body.body,
    });

    res.status(200).json(result);
  } catch (err) {
    console.log(err);
  }
};

const updateData = async (req, res) => {
  if (!req.body.id)
    return res.status(400).json({ message: "ID parameter is required." });

  try {
    const datas = await Data.findOne({ _id: req.body.id }).exec();
    if (!datas)
      return res
        .status(204)
        .json({ message: `Data not found with id ${req.body.id}` });

    if (req.body.title) datas.title = req.body.title;
    if (req.body.body) datas.body = req.body.body;
    const result = await datas.save();
    res.json(result);
  } catch (err) {
    console.log(err);
  }
};

const deleteData = async (req, res) => {
  if (!req.body.id)
    return res.status(400).json({ message: "ID parameter is required." });

  const datas = await Data.findOne({ _id: req.body.id }).exec();
  if (!datas)
    return res
      .status(204)
      .json({ message: `Data not found with id ${req.body.id}` });

  const result = await datas.deleteOne();
  res.json(result);
};

const getData = async (req, res) => {
  const result = await Data.findOne({ _id: req.params.id }).exec();
  if (!result)
    res
      .status(204)
      .json({ message: `Data not found with id ${req.params.id}` });

  res.json(result);
};

module.exports = {
  getAllData,
  addData,
  updateData,
  deleteData,
  getData,
};
