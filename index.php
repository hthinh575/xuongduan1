<?php
session_start();


//Database
include 'app/Database/Database.php';

//Model
include 'app/Models/Admin/HomeModel.php';

//Controller
include 'app/Controllers/Admin/HomeController.php';

const BASE_URL = "http://localhost/duan1/";
//Router
include 'router/web.php';
