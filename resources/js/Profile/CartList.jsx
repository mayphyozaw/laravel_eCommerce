import axios from "axios";
import React, { useEffect, useState } from "react";
import Spinner from "../Component/Spinner";
import SmallSpinner from "../Component/SmallSpinner";
import Nav from "./Component/Nav";

const CartList = () => {
    const [loader, setLoader] = useState(true);
    const [cart, setCart] = useState([]);
    const [qtyLoader, setQtyLoader] = useState(false);

    const user_id = window.auth.id;
    useEffect(() => {
        axios.get("/api/getCart?user_id=" + user_id).then((d) => {
            const { data } = d;
            setCart(data.data);
            setLoader(false);
        });
    }, []);

    const updateCart = (id, type) => {
        const updatedCart = cart.map((d) => {
            if (id == d.id) {
                switch (type) {
                    case "add":
                        d.total_qty += 1;
                        break;
                    default:
                        d.total_qty -= 1;
                        break;
                }
            }
            return d;
        });
        setCart(updatedCart);
    };

    const updateQty = (id, qty) => {
        setQtyLoader(id);
        axios
            .post("/api/updateCartQty", { cart_id: id, total_qty: qty })
            .then((d) => {
                console.log("Update qty", d);
                if (d.data.message == true) {
                    showToast("Cart Quantity updated");
                    setQtyLoader(false);
                }
            });
    };

    const removeCart = (id) => {
        axios.post("/api/removeCart", { cart_id: id }).then((d) => {
            if (d.data.message === true) {
                setCart((preCart) => preCart.filter((d) => d.id !== id));
                showToast("Product Removed from Cart");
            }
        });
    };

    const TotalPrice = () => {
        var total_price = 0;
        cart.map((d) => {
            total_price += d.product.sale_price * d.total_qty;
        });
        return <span>{total_price} ks</span>;
    };

    const checkout = () => {
        const user_id = window.auth.id;
        if (cart.length === 0) {
            showToast(
                "Please you need to add product before checkout",
                "error"
            );
            return;
        }
        axios.post("/api/checkout?user_id=" + user_id).then((d) => {
            if (d.data.message === true) {
                setCart([]);
                window.updateCart(0);
                showToast(
                    "Checkout Success. Please Wait For Shop Owner. You can view in Order List Tab."
                );
            }
        });
    };

    return (
        <section className="my__account--section section--padding">
            <div className="container">
                <div className="my__account--section__inner border-radius-10 d-flex">
                    <Nav />

                    <div className="account__wrapper">
                        <div className="account__content">
                            <h2 className="account__content--title mb-20">
                                Card Lists
                            </h2>
                            <hr />
                            <div className="cart__section--inner">
                                <div className="cart__table">
                                    {loader && <Spinner />}

                                    {!loader && (
                                        <table className="cart__table--inner">
                                            <thead className="cart__table--header">
                                                <tr className="cart__table--header__items">
                                                    <th className="cart__table--header__list">
                                                        Product
                                                    </th>
                                                    <th className="cart__table--header__list">
                                                        Price
                                                    </th>
                                                    <th className="cart__table--header__list">
                                                        Quantity
                                                    </th>
                                                    <th className="cart__table--header__list">
                                                        Total
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody className="cart__table--body">
                                                {cart.map((d) => (
                                                    <tr
                                                        className="cart__table--body__items"
                                                        key={d.id}
                                                    >
                                                        <td className="cart__table--body__list">
                                                            <div className="cart__product d-flex align-items-center">
                                                                <button
                                                                    onClick={() =>
                                                                        removeCart(
                                                                            d.id
                                                                        )
                                                                    }
                                                                    className="cart__remove--btn"
                                                                    aria-label="search button"
                                                                    type="button"
                                                                >
                                                                    <svg
                                                                        fill="currentColor"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 24 24"
                                                                        width="16px"
                                                                        height="16px"
                                                                    >
                                                                        <path d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z" />
                                                                    </svg>
                                                                </button>

                                                                <div className="cart__thumbnail">
                                                                    <img
                                                                        className="border-radius-5"
                                                                        style={{
                                                                            width: 70,
                                                                        }}
                                                                        src={
                                                                            d
                                                                                .product
                                                                                .image_url
                                                                        }
                                                                        alt={
                                                                            d
                                                                                .product
                                                                                .name
                                                                        }
                                                                    />
                                                                </div>
                                                                <div className="cart__content">
                                                                    <h3 className="cart__content--title h4">
                                                                        {
                                                                            d
                                                                                .product
                                                                                .name
                                                                        }
                                                                    </h3>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td className="cart__table--body__list">
                                                            <span className="cart__price">
                                                                {
                                                                    d.product
                                                                        .sale_price
                                                                }
                                                            </span>
                                                        </td>

                                                        <td className="cart__table--body__list">
                                                            <div className="quantity__box">
                                                                <button
                                                                    type="button"
                                                                    className="quantity__value quickview__value--quantity decrease"
                                                                    aria-label="quantity value"
                                                                    value="Decrease Value"
                                                                    onClick={() =>
                                                                        updateCart(
                                                                            d.id,
                                                                            "reduce"
                                                                        )
                                                                    }
                                                                >
                                                                    -
                                                                </button>
                                                                <label>
                                                                    <input
                                                                        type="number"
                                                                        className="quantity__number quickview__value--number"
                                                                        value={
                                                                            d.total_qty
                                                                        }
                                                                    />
                                                                </label>
                                                                <button
                                                                    type="button"
                                                                    className="quantity__value quickview__value--quantity increase mr-4"
                                                                    aria-label="quantity value"
                                                                    value="Increase Value"
                                                                    onClick={() =>
                                                                        updateCart(
                                                                            d.id,
                                                                            "add"
                                                                        )
                                                                    }
                                                                >
                                                                    +
                                                                </button>

                                                                <button
                                                                    onClick={() =>
                                                                        updateQty(
                                                                            d.id,
                                                                            d.total_qty
                                                                        )
                                                                    }
                                                                    className="cart__remove--btn"
                                                                    aria-label="search button"
                                                                    type="button"
                                                                >
                                                                    {qtyLoader ===
                                                                        d.id && (
                                                                        <SmallSpinner />
                                                                    )}
                                                                    <svg
                                                                        fill="currentColor"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 24 24"
                                                                        width="16px"
                                                                        height="16px"
                                                                    >
                                                                        <path d="M9 16.2l-4.2-4.2L3 14l6 6 12-12-1.8-1.8L9 16.2z" />
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </td>

                                                        <td className="cart__table--body__list">
                                                            <span className="cart__price end">
                                                                {d.product
                                                                    .sale_price *
                                                                    d.total_qty}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                ))}
                                            </tbody>

                                            <tfoot>
                                                <tr>
                                                    <td colSpan={3}>
                                                        <span
                                                            style={{
                                                                fontSize: 18,
                                                                fontWeight:
                                                                    "bold",
                                                            }}
                                                        >
                                                            Total Amount:
                                                        </span>
                                                    </td>

                                                    <td
                                                        className="cart__table--body__list"
                                                        style={{
                                                            fontSize: 18,
                                                            fontWeight: "bold",
                                                        }}
                                                    >
                                                        <span className="cart__price end">
                                                            <TotalPrice />
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    )}

                                    <div className="continue__shopping d-flex justify-content-end">
                                        <button
                                            className="cart__summary--footer__btn primary__btn checkout"
                                            type="button"
                                            onClick={() => checkout()}
                                        >
                                            Check Out
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
};

export default CartList;
