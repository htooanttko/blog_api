const express = require("express");
const router = express.Router();
const userController = require("../controllers/userController");
const RoleList = require("../config/role_list");
const verifyRoles = require("../middlewares/verifyRole");

router
  .route("/")
  .get(userController.getAllUser)
  .put(verifyRoles(RoleList.admin), userController.updateUser)
  .delete(verifyRoles(RoleList.admin), userController.deleteUser);

router.get("/:id", userController.getUser);

module.exports = router;
