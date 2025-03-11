import axios from "axios";
import React, { useEffect, useState } from "react";
import Spinner from "../Component/Spinner";
import SmallSpinner from "../Component/SmallSpinner";

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
        return <span>{total_price}ks</span>;
    };

    const checkout = () => {
        const user_id = window.auth.id;
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
        <div className="container-fluid mt-3">
            <div className="card p-3">
                <h4>Cart</h4>
                {loader && <Spinner />}

                {!loader && (
                    <>
                        <table className="table table-striped">
                            <thead>
                                <tr style={{ fontSize: 16 }}>
                                    <th style={{ width: 20 }}>Image</th>
                                    <th style={{ width: 10 }}>Name</th>
                                    <th style={{ width: 5 }}>Quantity</th>
                                    <th style={{ width: 10 }}>Sales Price</th>
                                    <th style={{ width: 10 }}>Add/Remove</th>

                                    <th style={{ width: 45 }}>Total Price</th>
                                </tr>
                            </thead>

                            <tbody>
                                {cart.map((d) => (
                                    <tr key={d.id}>
                                        <td>
                                            <img
                                                style={{ width: 70 }}
                                                src={d.product.image_url}
                                                alt={d.product.name}
                                            />
                                        </td>
                                        <td style={{ fontSize: 14 }}>
                                            {d.product.name}
                                        </td>
                                        <td style={{ fontSize: 14 }}>
                                            {d.total_qty}
                                        </td>
                                        <td style={{ fontSize: 14 }}>
                                            {d.product.sale_price}
                                        </td>
                                        <td>
                                            <button
                                                className="btn btn-dark btn-sm"
                                                onClick={() =>
                                                    updateCart(d.id, "reduce")
                                                }
                                            >
                                                -
                                            </button>
                                            <input
                                                type="text"
                                                className="btn border-warning"
                                                value={d.total_qty}
                                                disabled={true}
                                                style={{ fontSize: 14 }}
                                            />
                                            <button
                                                className="btn btn-dark btn-sm mr-4"
                                                onClick={() =>
                                                    updateCart(d.id, "add")
                                                }
                                            >
                                                +
                                            </button>
                                            <button
                                                className="btn btn-primary mr-4"
                                                onClick={() =>
                                                    updateQty(d.id, d.total_qty)
                                                }
                                            >
                                                {qtyLoader === d.id && (
                                                    <SmallSpinner />
                                                )}
                                                Save
                                            </button>
                                            <button
                                                className="btn btn-danger mr-4"
                                                onClick={() => removeCart(d.id)}
                                            >
                                                Delete
                                            </button>
                                        </td>

                                        <td
                                            className=" bg-dark text-white "
                                            style={{
                                                fontSize: 14,
                                                textAlign: "right",
                                            }}
                                        >
                                            {d.product.sale_price * d.total_qty}
                                        </td>
                                    </tr>
                                ))}
                                <tr>
                                    <td colSpan={5}>
                                        <span
                                            className="float-right"
                                            style={{ fontSize: 18 }}
                                        >
                                            Total Amount:
                                        </span>
                                    </td>
                                    <td
                                        className="float-right text-black"
                                        style={{ fontSize: 16 }}
                                    >
                                        <TotalPrice />
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div>
                            <button
                                className="btn btn-primary"
                                onClick={() => checkout()}
                            >
                                Checkout
                            </button>
                        </div>
                    </>
                )}
            </div>
        </div>
    );
};

export default CartList;
