<?php
class DashboardController {
    public function dashboard(){
        $categoryModel = new CategoryUserModel();
        $listCategory = $categoryModel->getCategoryDashboard();

        $productModel = new ProductUserModel();
        $listProduct = $productModel->getProductDashboard();
        include 'app/Views/Users/index.php';
    }

    public function myAccount(){
        include 'app/Views/Users/myaccount.php';
    }

    public function accountDetal(){
        $userModel = new UserModel2();
        $user = $userModel->getCurrenUser();
        include 'app/Views/Users/account-detal.php';
    }

    public function accountUpdate(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->changePassword();
            $userModel = new UserModel2();
            $user = $userModel->getCurrenUser();

            //Them anh
            $uploadDir = 'assets/Admin/upload/';
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $destPath = $user->image;

            if(!empty($_FILES['image']['name'])){
                $fileTmpPath = $_FILES['image']['tmp_name'];
                $fileType = mime_content_type($fileTmpPath);
                $fileName = basename($_FILES['image']['name']);
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                $newFileName = uniqid() . '.' . $fileExtension;
                if(in_array($fileType, $allowedTypes)){
                    $destPath = $uploadDir . $newFileName;
                    if(!move_uploaded_file($fileTmpPath, $destPath)){
                        $destPath = "";
                    }
                    //xóa ảnh cũ
                    unlink($user->image);
                }
            }

            $userModel = new UserModel2();
            $message = $userModel->updateCurrentUser($destPath);


            if($message){
                $_SESSION['message'] = "Cập nhật thành công!";
                header("Location: " . BASE_URL . "?act=account-detal");
                exit;
            }else{
                $_SESSION['message'] = "Cập nhật không thành công!";
                header("Location: " . BASE_URL . "?act=account-detal");
                exit;
            }
        }
    }

    public function changePassword(){
        if(
            $_POST['current-password'] != "" &&
            $_POST['new-password'] != "" &&
            $_POST['confirm-password'] != "" &&
            $_POST['new-password'] == $_POST['confirm-password']
        ){
            $userModel = new UserModel2();
            $userModel->changePassword();

        }
    }

    public function showShop(){
        $productModel = new ProductUserModel();
        $listProduct = $productModel->getDataShop();


        $categoryModel = new CategoryUserModel();
        if(isset($_GET['category_id'])){
            $category = $categoryModel->getCategoryById($_GET['category_id']);
        }
        $listCategory = $categoryModel->getCategoryDashboard();
        $stock = $productModel->getProductStock();

        if(isset($_GET['instock'])){
            $listProduct = array_filter($listProduct, function ($product){
                return $product->stock > 0;
            });
        }

        if(isset($_GET['outstock'])){
            $listProduct = array_filter($listProduct, function ($product){
                return $product->stock == 0;
            });
        }

        if(isset($_GET['min'])){
            $listProduct = array_filter($listProduct, function ($product){
                if($product->price_sale != null){
                    return $product->price_sale > $_GET['min'];
                }
                return $product->price > $_GET['min'];
            });
        }

        if(isset($_GET['max'])){
            $listProduct = array_filter($listProduct, function ($product){
                if($product->price_sale != null){
                    return $product->price_sale < $_GET['max'];
                }
                return $product->price < $_GET['max'];
            });
        }

        if(isset($_GET['product-name'])){
            $listProduct = $productModel->getDataShopName();
        }

        include 'app/Views/Users/shop.php';
    }

    public function productDetail(){
        $productModel = new ProductUserModel();
        $product = $productModel->getProductById();

        $productImage = $productModel->getProductImageById();

        include 'app/Views/Users/product-detail.php';
    }
}