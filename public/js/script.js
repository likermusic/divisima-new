// Переключение категорий и получение товаров по этой категории
document
  .querySelector(".product-filter-menu")
  .addEventListener("click", (e) => {
    e.preventDefault();
    if (e.target.matches("a")) {
      document
        .querySelector(".product-filter-menu a.active")
        .classList.remove("active");
      e.target.classList.add("active");

      const categoryId = e.target.dataset.id;
      categoryProductsHandler(categoryId);
    }
  });

// Подгрузка товаров на главной
document.querySelector(".load-more").addEventListener("click", (e) => {
  e.target.innerHTML = `Loading...<div class="spinner-border spinner-border-sm ml-2" role="status">
        <span class="visually-hidden"></span>
      </div>`;
  const start = document.querySelectorAll(".products .product-wrapper").length;

  const categoryId = document.querySelector(".product-filter-menu a.active")
    .dataset.id;
  // productsHandler(start, e.target);
  categoryProductsHandler(categoryId, start, e.target);
});

document
  .querySelector(".product-filter-section .products")
  .addEventListener("click", checkProductInFavourites);

document
  .querySelector(".top-letest-product-section .product-slider")
  .addEventListener("click", checkProductInFavourites);

document
  .querySelector(".top-letest-product-section .product-slider")
  .addEventListener("click", addToCart);

document
  .querySelector(".product-filter-section .products")
  .addEventListener("click", addToCart);

function addToCart(e) {
  e.preventDefault();
  if (e.target.matches(".add-card, .add-card *")) {
    const productId = e.target.closest(".product-item")?.dataset.id;

    const body = JSON.stringify({ productId });
    addToCartHandler(e.target, body);
  }
}

function addToCartHandler(elem, body) {
  fetch("addToCart", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
      credentials: "same-origin",
      "X-Requested-With": "XMLHttpRequest",
    },
    body: body,
  })
    .then((resp) => {
      if (!resp.ok) {
        throw new Error("Ошибка запроса к серверу. Попробуйте позже");
      }
      return resp.json();
    })
    .then((data) => {
      if (data === false) {
        throw new Error("Ошибка добавления в корзину. Попробуйте позже");
      } else {
        // УСПЕХ
        const alert = `
            <div class="alert alert-add-product text-white bg-dark" style="opacity: 0.8!important" role="alert">
              Товар добавлен в корзину!
            </div>
            `;
        let alertElem;
        // && !elem.parentElement.querySelector(".alert-add-product")
        if (elem.matches(".add-card")) {
          // console.log(elem.parentElement.querySelector(".alert-add-product"));
          // elem.parentElement.querySelector(".alert-add-product")?.remove();
          elem.insertAdjacentHTML("beforebegin", alert);
          alertElem = elem.previousElementSibling;
        } else {
          // console.log(elem.parentElement.querySelector(".alert-add-product"));
          // elem.parentElement.querySelector(".alert-add-product")?.remove();
          elem.closest(".add-card").insertAdjacentHTML("beforebegin", alert);
          alertElem = elem.closest(".add-card").previousElementSibling;
        }

        setTimeout(() => {
          alertElem.remove();
        }, 1500);

        document.querySelector(".shopping-card span").textContent =
          Number(document.querySelector(".shopping-card span").textContent) + 1;
      }
    })
    .catch((err) => {
      if (PROD) {
        alert(err);
      } else {
        console.error(err);
      }
    });
}

function checkProductInFavourites(e) {
  e.preventDefault();
  if (e.target.matches(".wishlist-btn, .wishlist-btn *")) {
    const productId = e.target.closest(".product-item")?.dataset.id;
    const body = JSON.stringify({ productId });

    if (e.target.matches(".wishlist-btn")) {
      const isFavourite = e.target
        .querySelector("i")
        .classList.contains("favourite");
      if (!isFavourite) {
        addToFavouritesHandler(e.target, body);
      } else {
        deleteFromFavouritesHandler(e.target, body);
      }
    } else {
      const isFavourite = e.target.classList.contains("favourite");
      if (!isFavourite) {
        addToFavouritesHandler(e.target, body);
      } else {
        deleteFromFavouritesHandler(e.target, body);
      }
    }
  }
}

function renderProducts(data) {
  let output = "";
  data.forEach((product) => {
    output += `
        <div class="col-lg-3 col-sm-6 product-wrapper">
          <div class="product-item" data-id="${
            product.id
          }" data-category="<?= ${product.category_id}">
            <div class="pi-pic">
              ${
                product.discount > 0
                  ? '<div class="tag-sale">ON SALE</div>'
                  : ""
              }
              <img src="${WWW}/img/product/${product.image}" alt="product">
              <div class="pi-links">
                <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
                <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
              </div>
            </div>
            <div class="pi-text">
              <h6>
                ${
                  product.discount > 0
                    ? `
                  <s>$${product.price.replace(".", ",")}</s>
                  <br>
                  $${(product.price - (product.price / 100) * product.discount)
                    .toFixed(2)
                    .toString()
                    .replace(".", ",")}
                  `
                    : `$${product.price.replace(".", ",")}`
                }
              </h6>
              <p>${product.name}</p>
            </div>
          </div>
        </div>
        `;
  });

  document.querySelector(".products").insertAdjacentHTML("beforeend", output);
}

// Fetch queries
function addToFavouritesHandler(elem, body) {
  fetch("addToFavourites", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
      credentials: "same-origin",
      "X-Requested-With": "XMLHttpRequest",
    },
    body: body,
  })
    .then((resp) => {
      if (!resp.ok) {
        throw new Error("Ошибка запроса к серверу. Попробуйте позже");
      }
      return resp.json();
    })
    .then((data) => {
      if (!data) {
        throw new Error("Ошибка добавления в избранное. Попробуйте позже");
      } else if (data === 401) {
        const favouritesErrorModal = new bootstrap.Modal(
          document.getElementById("favouritesErrorModal")
        );
        favouritesErrorModal.show();
      } else {
        // УСПЕХ
        if (elem.matches(".wishlist-btn")) {
          elem.querySelector("i").classList.add("favourite");
        } else {
          elem.classList.add("favourite");
        }
      }
    })
    .catch((err) => {
      if (PROD) {
        alert(err);
      } else {
        console.error(err);
      }
    });
}

function deleteFromFavouritesHandler(elem, body) {
  fetch("deleteFromFavourites", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
      credentials: "same-origin",
      "X-Requested-With": "XMLHttpRequest",
    },
    body: body,
  })
    .then((resp) => {
      if (!resp.ok) {
        throw new Error("Ошибка запроса к серверу. Попробуйте позже");
      }
      return resp.json();
    })
    .then((data) => {
      if (!data) {
        throw new Error("Ошибка удаления из избранного. Попробуйте позже");
      } else {
        // УСПЕХ
        if (elem.matches(".wishlist-btn")) {
          elem.querySelector("i").classList.remove("favourite");
        } else {
          elem.classList.remove("favourite");
        }
      }
    })
    .catch((err) => {
      if (PROD) {
        alert(err);
      } else {
        console.error(err);
      }
    });
}

function categoryProductsHandler(categoryId, start, loadMore) {
  let body = JSON.stringify(
    start
      ? { categoryId: Number(categoryId), start: Number(start) }
      : { categoryId: Number(categoryId) }
  );
  document.querySelector(".products").classList.add("products-blur");
  const spinner = `
  <div class="products-spinner">
    <div class="spinner-border spinner-border-lg ml-2" role="status">
      <span class="visually-hidden"></span>
    </div>
  </div>`;
  document.querySelector(".products").insertAdjacentHTML("beforeend", spinner);

  fetch("categoryProductsHandler", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
      credentials: "same-origin",
      "X-Requested-With": "XMLHttpRequest",
    },
    body: body,
  })
    .then((resp) => {
      if (!resp.ok) {
        throw new Error("Ошибка запроса к серверу. Попробуйте позже");
      }
      return resp.json();
    })
    .then((data) => {
      if (!data) {
        throw new Error(
          "Ошибка получения товаров по категории. Попробуйте позже"
        );
      } else {
        if (!start) {
          // проверяет Load more... ИЛИ Перекл кат
          document.querySelector(".products").innerHTML = "";
          if (data.length === 0) {
            document.querySelector(".products").innerHTML =
              "<h3>Товары закончились :(</h3>";
            // document.querySelector(".load-more").remove();
          } else {
            renderProducts(data);
          }
        } else {
          renderProducts(data);
        }
      }
    })
    .catch((err) => {
      if (PROD) {
        alert(err);
      } else {
        console.error(err);
      }
    })
    .finally(() => {
      if (loadMore) {
        loadMore.textContent = "LOAD MORE";
      }
      document.querySelector(".products").classList.remove("products-blur");
    });
}
