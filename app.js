require("dotenv").config();
const express = require("express");
const app = express();
const path = require("path");
const cors = require("cors");
const credentials = require("./middlewares/credentials");
const corsOption = require("./config/corsOption");
const cookieParser = require("cookie-parser");
const verifyJWT = require("./middlewares/verifyJWT");
const mongoose = require("mongoose");
const connectDB = require("./config/dbconn");
const PORT = process.env.PORT || 3500;

// connecting DataBase
connectDB();

// middlewares
app.use(credentials); // credentials check - before CORS!   and fetch cookies credentials requirement
app.use(cors(corsOption));
app.use(express.json());

// built-in middleware to handle urlencoded form data ( only work on encoded url body )
app.use(express.urlencoded({ extended: false }));

// cookie middleware
app.use(cookieParser());

// server static file
app.use("/", express.static(path.join(__dirname, "/public")));

// route
app.use("/auth", require("./routes/auth"));
app.use("/refresh", require("./routes/refresh"));

app.use(verifyJWT);
app.use("/users", require("./routes/user"));
app.use("/", require("./routes/data"));

// for 404
app.all("*", (req, res) => {
  res.status(404);
  if (req.accepts("html")) {
    res.sendFile(path.join(__dirname, "views", "404.html"));
  } else if (req.accepts("json")) {
    res.json({ error: "404 not found" });
  } else {
    res.type("txt").send("404 not found");
  }
});

mongoose.connection.once("open", () => {
  console.log("MongoDB is connected");
  app.listen(PORT, () => console.log(`Server is running on PORT: ${PORT}`));
});
