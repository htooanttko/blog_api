const allowedOrigin = require("./allowedOrigin");

const corsOption = {
  origin: (origin, callback) => {
    if (
      allowedOrigin.indexOf(origin) !== -1 ||
      allowedOrigin.includes(origin) ||
      !origin
    ) {
      callback(null, true);
    } else {
      callback(new Error("Not Allowed by CORS"));
    }
  },
  methods: "GET,HEAD,PUT,PATCH,POST,DELETE",
  optionsSuccessStatus: 200,
};

module.exports = corsOption;
