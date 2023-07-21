<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: home.php');
}

$_SESSION['table'] = 'products';

$products = include('database/show-products.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('partials/app-header-script.php'); ?>
    <title>View Products - Pos System</title>
</head>

<body>
    <div id="dashboard_main_container">
        <?php include('partials/sidebar.php'); ?>
    </div>

    <div class="dashboard-content-container" id="dashboard_content_container">
        <?php include('partials/topNav.php') ?>

        <div class="dashboard-content">
            <div class="dashboard-content-main">
                <div class="row">
                    <div class="column column-7">
                        <h1 class="section-header"><i class="fa fa-list"></i>List Of Products</h1>
                        <div class="section-content">
                            <div class="users">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Description</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($products as $index => $product) { ?>
                                            <tr>
                                                <td id="userId"><?= $index + 1 ?></td>
                                                <td class="firstName" id="firstName">
                                                    <img class="productImages" src="uploads/products/<?= $product['img'] ?>" alt="">
                                                </td>
                                                <td class="lastName" id="lastName"><?= $product['product_name'] ?></td>
                                                <td class="email" id="email"><?= $product['description'] ?></td>
                                                <td>
                                                    <?php
                                                    $pid = $product['created_by'];
                                                    $stmt = $cnx->prepare("SELECT * FROM users  WHERE id = $pid ORDER BY created_at DESC  ");
                                                    $stmt->execute();
                                                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                                    $created_by_name = $row['first_name'] . ' ' . $row['last_name'];
                                                    echo $created_by_name;
                                                    ?>
                                                </td>
                                                <td><?= date('M d,Y @ h:i:s A', strtotime($product['created_at'])) ?></td>
                                                <td><?= date('M d,Y @ h:i:s A', strtotime($product['updated_at'])) ?></td>
                                                <td>
                                                    <a href="#" class="updateProduct" data-pid="<?= $product['id'] ?>"><i class="fa fa-pencil"></i>Edit</a>
                                                    <a href="#" class="deleteProduct" data-name="<?= $product['product_name'] ?>" data-pid="<?= $product['id'] ?>"><i class="fa fa-trash"></i>Delete</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <p class="userCount"><?= count($products) ?> Products</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('partials/app-script.php'); ?>

    <script>
        function script() {
            var vm = this;

            this.registerEvents = function () {
                document.addEventListener("click", function (e) {
                    targetElement = e.target; //target Element 
                    classList = targetElement.classList;

                    if (classList.contains("deleteProduct")) {
                        e.preventDefault(); //this prevents the default mechanism.

                        pId = targetElement.dataset.pid;
                        pName = targetElement.dataset.name;

                        BootstrapDialog.confirm({
                            type: BootstrapDialog.TYPE_DANGER,
                            title: "Delete Product",
                            message: "Are You sure to delete <strong> " + " " + pName + "</strong>?",
                            callback: function (isDelete) {
                                if (isDelete) {
                                    $.ajax({
                                        method: 'POST',
                                        data: {
                                            id: pId,
                                            table: 'products'
                                        },
                                        url: 'database/delete-product.php',
                                        dataType: 'json',
                                        success: function (data) {
                                            message = data.success ?
                                                pName + "  Successfully deleted" : "Error processing your request ";

                                            BootstrapDialog.alert({
                                                type: data.success ? BootstrapDialog.TYPE_SUCCESS : BootstrapDialog.TYPE_DANGER,
                                                message: message,
                                                callback: function () {
                                                    if (data.success) location.reload();
                                                }
                                            });
                                        }
                                    });
                                }
                            }
                        });
                    }

                    if (classList.contains("updateProduct")) {
                        e.preventDefault(); //this prevents the default mechanism.

                        pId = targetElement.dataset.pid;
                        vm.showEditDialog(pId);
                    }
                });

                $('#editProductForm').on('submit', function (e) {
                    e.preventDefault();
                });
                document.addEventListener('submit', function (e) {
                    e.preventDefault();
                    targetElement = e.target;

                    if (targetElement.id == 'editProductForm') {
                        vm.saveUpdateData(targetElement);
                    }
                })
            },

            this.saveUpdateData = function(form){

                $.ajax({
                    method: 'POST',
                    data: new FormData(form),
                    url: 'database/update-product.php',
                    /* we remplace dataType:'json'with those thing ,and this will wnsure that we are 
                    we are not sending a string to our server */
                    processData: false,
                    contentType: false,
                    dataType:'json',
                    success: function (data) {
                        //makaynch ra7a 
                        BootstrapDialog.alert({
                            type: data.success ? BootstrapDialog.TYPE_SUCCESS : BootstrapDialog.TYPE_DANGER,
                            message: data.message,
                            callback: function(){
                                if(data.success) location.reload();
                            }
                        });
                        // if (data.success) {
                        //     BootstrapDialog.alert({
                        //         type: BootstrapDialog.TYPE_SUCCESS,
                        //         message: data.message,
                        //         callback: function () {
                        //             location.reload();
                        //         }
                        //     });
                        // } else {
                        //     BootstrapDialog.alert({
                        //         type: BootstrapDialog.TYPE_DANGER,
                        //         message: data.message,
                        //     });
                        //}
                    }
                });
            },

            this.showEditDialog = function (id) {
                const p_name = targetElement.closest("tr").querySelector("td.lastName").innerHTML;
                const p_desc = targetElement.closest("tr").querySelector("td.email").innerHTML;
                $.get('database/get-product.php', { id: id }, function(productDetails) {
                    BootstrapDialog.confirm({
                        title: 'Update <strong>' + productDetails.product_name + '</strong>',
                        message: '\
                        <form action="database/add.php" method="POST" enctype="multipart/form-data" id="editProductForm">\
                            <div class="info-person" style="display: flex;flex-direction: column;justify-content: space-between;margin-bottom: 15px;">\
                                <div>\
                                    <label for="product_name" style="font-weight: bold;font-size: 2rem;margin-top: 1rem;color:#6571ff;">Product Name</label>\<br>\
                                    <input type="text" id="product_name" name="product_name" value="' + productDetails.product_name + '" placeholder="Enter your product name..." style="width: 100%;padding: 15px 20px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;margin-top: 5px;">\<br>\
                                </div>\
                                <div>\
                                    <label for="description" style="font-weight: bold;font-size: 2rem;margin-top: 1rem;color: #6571ff;">Description</label>\<br>\
                                    <textarea class="description" id="description" name="description" placeholder="Enter your product description..."style="margin-top: 1rem;width: 100%; height: 75px;border: 1px solid #ccc;padding: 10px;">' + productDetails.description + '</textarea>\
                                </div>\
                            </div>\
                            <div class="info-person">\
                                <div>\
                                    <label for="product_image" style="font-weight: bold;font-size: 2rem;margin-top: 1rem;color:#6571ff;">Product Image</label>\<br>\
                                    <input type="file" id="img" name="img"  style="width: 100%;padding: 15px 20px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;margin-top: 5px;">\
                                </div>\
                            </div>\
                            <input  type="hidden" name="pid" value="'+ productDetails.id + '">\
                            <input type="submit" value="submit" id="editProductSubmitBtn" class="hidden">\
                        </form>\
                    ',

                        callback: function (isUpdate) {
                            if (isUpdate) {
                                document.getElementById('editProductSubmitBtn').click();
                            }
                        }
                    });
                }, 'json');
            },

            this.initialize = function () {
                this.registerEvents();
            }
        }

        var script = new script;
        script.initialize();
    </script>
</body>

</html>
