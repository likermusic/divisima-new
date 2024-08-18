<!-- Page info -->
<div class="page-top-info">
  <div class="container">
    <h4>Your cart</h4>
    <div class="site-pagination">
      <a href="/">Home</a> /
      <span>Your cart</span>
    </div>
  </div>
</div>
<!-- Page info end -->

<!-- cart section end -->
<section class="cart-section spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="cart-table">
          <h3>Your Cart</h3>
          <div class="cart-table-warp">
            <table>
              <thead>
                <tr>
                  <th class="product-th">Product</th>
                  <th class="quy-th">Quantity</th>
                  <th class="total-th">Price</th>
                </tr>
              </thead>
              <tbody>
                <? foreach ($data->cart as $product): ?>
                  <? $total += $product->price * $product->qty ?>
                  <tr>
                    <td class="product-col">
                      <img src="<?= WWW ?>/img/product/<?= $product->image ?>" alt="product">
                      <div class="pc-title">
                        <h4><?= $product->name ?></h4>
                        <p>$<?= $product->price ?></p>
                      </div>
                    </td>
                    <td class="quy-col">
                      <div class="quantity">
                        <div class="pro-qty">
                          <input type="text" value="<?= $product->qty ?>">
                        </div>
                      </div>
                    </td>
                    <td class="total-col">
                      <h4>$<span id="total-product"><?= $total ?></span></h4>
                    </td>
                  </tr>
                <? endforeach; ?>
              </tbody>
            </table>
          </div>
          <div class="total-cost">
            <h6>Total <span>$ <span class="ml-0"
                  id="total-cost"><?= $total += $product->price * $product->qty ?></span></span></h6>
          </div>
        </div>
      </div>
      <div class="col-lg-4 card-right">
        <!-- <form class="promo-code-form">
          <input type="text" placeholder="Enter promo code">
          <button>Submit</button>
        </form> -->
        <a href="" class="site-btn">Proceed to checkout</a>
        <a href="/" class="site-btn sb-dark">Continue shopping</a>
      </div>
    </div>
  </div>
</section>
<!-- cart section end -->