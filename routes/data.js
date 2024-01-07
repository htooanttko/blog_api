const express = require("express");
const router = express.Router();
const dataController = require("../controllers/dataController");
const RoleList = require("../config/role_list");
const verifyRoles = require("../middlewares/verifyRole");

router
  .route("/")
  .get(dataController.getAllData)
  .post(verifyRoles(RoleList.admin), dataController.addData)
  .put(verifyRoles(RoleList.admin), dataController.updateData)
  .delete(verifyRoles(RoleList.admin), dataController.deleteData);

router.get("/:id", dataController.getData);
module.exports = router;
