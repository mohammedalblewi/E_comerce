<?php require_once "connection.php"; ?>
<?php require 'header.php'; ?>
<?php
  
session_start();
  
?>

<!-- //////////////////////////////////////////////////// -->

<!-- banner -->
<div class="heading-container heading-resize heading-button">
    <div class="heading-background heading-parallax bg-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading-wrap">
                        <div class="page-title">
                            <h1>Nunc interdum</h1>
                            <span class="subtitle">Women</span>
                            <a class="btn btn-white-outline heading-button-btn" href="#" title="Buy Now">Buy Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- fillter -->
<?php

if (isset($_POST['filter'])) {
    $min_price = $_POST['min_price'];
    $max_price = $_POST['max_price'];

    $query = "SELECT * from `products` where products.price >= ? and products.price <= ? ";
    $query = $connect->prepare($query);
    $query->execute([$min_price, $max_price]);

    $products = $query->fetchAll(PDO::FETCH_OBJ);
    // print_r($products);
} else {

    $query = "SELECT * from `products`";
    $query = $connect->prepare($query);
    $query->execute();

    $products = $query->fetchAll(PDO::FETCH_OBJ);
   
}


$query = "SELECT * from categories";
$query = $connect->prepare($query);
$query->execute();

$categories = $query->fetchAll(PDO::FETCH_OBJ);
// print_r($categories);



$sql1 = $connect->query('SELECT * FROM products');
while ($prod = $sql1->fetch(PDO::FETCH_ASSOC)) {
print_r($prod);}

?>


<div class="content-container">
    <div class="container">
        <div class="row">
            <div class="col-md-3 sidebar-wrap">
                <div class="main-sidebar">
                    <div class="widget shop widget_price_filter">
                        <h4 class="widget-title"><span>Price</span></h4>
                        <form method="post" action="shop.php">
                            <div class="price_slider_wrapper">
                                <div class="price_slider"></div>
                                <div class="price_slider_amount">
                                    <input type="text" id="min_price" name="min_price" value="50" data-min="10" placeholder="Min price" />
                                    <input type="text" id="max_price" name="max_price" value="<?php echo $max_price ?>" data-max="100" placeholder="Max price" />
                                    <button type="submit" name="filter" class="button">Filter</button>
                                    <div class="price_label">
                                        Price: <span class="from"></span> &mdash; <span class="to"></span>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- <div class="widget shop widget_swatches">
									<h4 class="widget-title"><span>Sizes</span></h4>
									<ul class="swatches-options clearfix">
										<li>
											<a title="Extra Large (3)" href="#">
												<img src="../images/sizes/XL.jpg" alt="Extra Large" width="32" height="32"/>
											</a>
										</li>
										<li>
											<a title="Extra Extra Large (3)" href="#">
												<img src="../images/sizes/XXL.jpg" alt="Extra Extra Large" width="32" height="32"/>
											</a>
										</li>
										<li>
											<a title="Large (3)" href="#">
												<img src="../images/sizes/L.jpg" alt="Large" width="32" height="32"/>
											</a>
										</li>
										<li>
											<a title="Medium (3)" href="#">
												<img src="../images/sizes/M.jpg" alt="Medium" width="32" height="32"/>
											</a>
										</li>
										<li>
											<a title="Small (3)" href="#">
												<img src="../images/sizes/S.jpg" alt="Small" width="32" height="32"/>
											</a>
										</li>
									</ul>
								</div> -->

                    <div class="widget shop widget_products">
                        <h4 class="widget-title"><span>Best Sellers</span></h4>
                        <ul class="product_list_widget">
                            <li>
                                <a href="#" title="Donec tincidunt justo">
                                    <img width="100" height="150" src="../images/product/product-13.jpg" alt="Product-13" />
                                    <span class="product-title">Donec tincidunt justo</span>
                                </a>
                                <del><span class="amount">&#36;20.50</span></del>
                                <ins><span class="amount">&#36;19.00</span></ins>
                            </li>
                            <li>
                                <a href="#" title="Nunc lacus sem">
                                    <img width="100" height="150" src="../images/product/product-11.jpg" alt="Product-11" />
                                    <span class="product-title">Nunc lacus sem</span>
                                </a>
                                <span class="amount">&#36;10.95</span>
                            </li>
                            <li>
                                <a href="#" title="Mauris egestas">
                                    <img width="100" height="150" src="../images/product/product-10.jpg" alt="Product-10" />
                                    <span class="product-title">Mauris egestas</span>
                                </a>
                                <span class="amount">&#36;14.95</span>
                            </li>
                            <li>
                                <a href="#" title="Morbi fermentum">
                                    <img width="100" height="150" src="../images/product/product-9.jpg" alt="Product-9" />
                                    <span class="product-title">Morbi fermentum</span>
                                </a>
                                <span class="amount">&#36;17.45</span>
                            </li>
                            <li>
                                <a href="#" title="Morbi fermentum">
                                    <img width="100" height="150" src="../images/product/product-8.jpg" alt="Product-8" />
                                    <span class="product-title">Morbi fermentum</span>
                                </a>
                                <span class="amount">&#36;23.00</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="col-md-9 main-wrap" main-wrap class="main-content  ">
                <div data-itemselector=".product.infinite-scroll-item" data-layout="masonry" data-paginate="infinite_scroll" data-masonry-column="4" class="shop products-masonry  infinite-scroll masonry">
                    <div class="masonry-filter">
                        <div class="filter-action filter-action-center">
                            <ul data-filter-key="filter">
                                <li>
                                    <a class="selected" href="./shop.php" data-filter-value="*">All</a>
                                </li>
                                <?php
                                foreach ($categories as $categorie) {

                                ?>

                                    <li>
                                        <a href="./shop.php" data-filter-value=".<?php echo trim($categorie->name) ?>"><?php echo ucfirst($categorie->name)  ?></a>
                                    </li>
                                <?php } ?>

                            </ul>
                        </div>
                    </div>



                    <div class="products-masonry-wrap">

                        <ul class="products masonry-products row masonry-wrap">
                            <?php
                            foreach ($products as $product) {
                                foreach ($categories as $categorie) {

                                    if ($product->category_id == $categorie->category_id) break;
                                }
                            ?>
                                <li class="product masonry-item col-md-3 col-sm-6 <?php echo trim($categorie->name)  ?>">
                                    <div class="product-container">
                                        <figure>
                                            <div class="product-wrap">
                                                <div class="product-images">
                                                    <div class="shop-loop-thumbnail">
                                                        <img width="300" height="350" src="../images/product/<?php echo $product->image1 ?>" alt="Product" />
                                                    </div>
                                                    <!-- <div class="yith-wcwl-add-to-wishlist">
																<div class="yith-wcwl-add-button">
																	<a href="#" class="add_to_wishlist">
																		Add to Wishlist
																	</a>
																</div>
															</div> -->
                                                    <div class="clear"></div>
                                                    <div class="shop-loop-quickview">
                                                        <a href="#" data-rel="quickViewModal"><i class="fa fa-plus"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <figcaption>
                                                <div class="shop-loop-product-info">
                                                    <div class="info-title">
                                                        <h3 class="product_title"><a href="#"><?php echo $product->name ?></a></h3>
                                                    </div>
                                                    <div class="info-meta">
                                                        <div class="info-price">
                                                            <span class="price">
                                                                <span class="amount">JD <?php echo $product->price ?></span>
                                                            </span>
                                                        </div>
                                                        <div class="loop-add-to-cart">
                                                            <a href="#">Select options</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </li>

                            <?php } ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    document.body.classList.add("shop", "page-layout-left-sidebar")
</script>

<?php require 'footer.php'; ?>