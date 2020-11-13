<?php


?>

<section id="page-content" class="sidebar-left">
    <div class="container">
        <div class="row">
            <!-- Content-->
            <div class="content col-lg-9">
                <div class="row m-b-20">
                    <div class="col-lg-6 p-t-10 m-b-20">
                        <h3 class="m-b-20">A Monochromatic Spring ’15</h3>
                        <p>Lorem ipsum dolor sit amet. Accusamus, sit, exercitationem, consequuntur, assumenda iusto eos commodi alias.</p>
                    </div>
                    <div class="col-lg-3">
                        <div class="order-select">
                            <h6>Sort by</h6>
                            <p>Showing 1&ndash;12 of 25 results</p>
                            <form method="get">
                                <select class="form-control">
                                    <option selected="selected" value="order">Default sorting</option>
                                    <option value="popularity">Sort by popularity</option>
                                    <option value="rating">Sort by average rating</option>
                                    <option value="date">Sort by newness</option>
                                    <option value="price">Sort by price: low to high</option>
                                    <option value="price-desc">Sort by price: high to low</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="order-select">
                            <h6>Sort by Price</h6>
                            <p>From 0 - 190$</p>
                            <form method="get">
                                <select class="form-control">
                                    <option selected="selected" value="">0$ - 50$</option>
                                    <option value="">51$ - 90$</option>
                                    <option value="">91$ - 120$</option>
                                    <option value="">121$ - 200$</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Product list-->
                <div class="shop">
                    <div class="grid-layout grid-3-columns" data-item="grid-item">


                       <?php

                       echo \yii\widgets\ListView::widget([
                           'dataProvider'=>$dataProvider,
                           'itemView'=>'_product'
                       ])
                       ?>
                    </div>
                    <hr>
                    <!-- Pagination -->
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item active"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                    <!-- end: Pagination -->
                </div>
                <!--End: Product list-->
            </div>
            <!-- end: Content-->
            <!-- Sidebar-->
            <div class="sidebar col-lg-3">
                <!--widget newsletter-->


                <?php
                foreach ($widgets as $widget){
                    if(isset($widget['class'])){
                        $data = $widget['data']??null;
                        echo $widget['class']::widget($data);
                    }
                }
                ?>

            </div>
            <!-- end: Sidebar-->
        </div>
    </div>
</section>
