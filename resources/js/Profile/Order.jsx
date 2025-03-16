import axios from "axios";
import React, { useEffect, useState } from "react";
import Spinner from "../Component/Spinner";
import Nav from "./Component/Nav";

const Order = () => {
    const [loader, setLoader] = useState(true);
    const [order, setOrder] = useState();
    const [page, setPage] = useState(1);

    const user_id = window.auth.id;
    useEffect(() => {
        axios
            .get(`/api/order?page=${page}&user_id=${user_id}`)
            .then(({ data }) => {
                setOrder(data.data);
                setLoader(false);
            });
    }, [page]);

    return (
        <section className="my__account--section section--padding">
            <div className="container">
                <div className="my__account--section__inner border-radius-10 d-flex">
                    <Nav />

                    <div className="account__wrapper">
                        <div className="account__content">
                            <h2 className="account__content--title mb-20">
                                Order Lists
                            </h2>
                            <hr />
                            <div className="cart__section--inner">
                                <div className="cart__table">
                                    {loader && <Spinner />}

                                    {!loader && (
                                        <>
                                            <table className="cart__table--inner">
                                                <thead className="cart__table--header">
                                                    <tr className="cart__table--header__items">
                                                        <th className="cart__table--header__list">
                                                            Image
                                                        </th>

                                                        <th className="cart__table--header__list">
                                                            Product
                                                        </th>

                                                        <th className="cart__table--header__list">
                                                            Qty
                                                        </th>

                                                        <th className="cart__table--header__list">
                                                            Price
                                                        </th>

                                                        <th className="cart__table--header__list">
                                                            Status
                                                        </th>
                                                    </tr>
                                                </thead>

                                                <tbody className="cart__table--body">
                                                    {order.data.map((d) => (
                                                        <tr key={d.id}>
                                                            <td>
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
                                                            </td>
                                                            <td
                                                                style={{
                                                                    fontSize: 14,
                                                                }}
                                                            >
                                                                {d.product.name}
                                                            </td>
                                                            <td
                                                                style={{
                                                                    fontSize: 14,
                                                                }}
                                                            >
                                                                {d.total_qty}
                                                            </td>
                                                            <td
                                                                style={{
                                                                    fontSize: 14,
                                                                }}
                                                            >
                                                                {
                                                                    d.product
                                                                        .sale_price
                                                                }
                                                            </td>
                                                            <td
                                                                style={{
                                                                    fontSize: 18,
                                                                }}
                                                            >
                                                                {d.status ===
                                                                    "cancel" && (
                                                                    <span class="badge badge-danger">
                                                                        <h1>
                                                                            Cancel
                                                                        </h1>
                                                                    </span>
                                                                )}

                                                                {d.status ===
                                                                    "success" && (
                                                                    <span className="badge badge-success">
                                                                        Success
                                                                    </span>
                                                                )}

                                                                {d.status ===
                                                                    "pending" && (
                                                                    <span className="badge badge-warning">
                                                                        Pending
                                                                    </span>
                                                                )}
                                                            </td>
                                                        </tr>
                                                    ))}
                                                </tbody>
                                            </table>

                                            <div className="p-3 text-center">
                                                <button
                                                    className="btn btn-dark btn-lg mr-4"
                                                    disabled={
                                                        !order.prev_page_url ||
                                                        page === 1
                                                    }
                                                    onClick={() =>
                                                        setPage(page - 1)
                                                    }
                                                >
                                                    <i className="fas fa-arrow-left"></i>
                                                </button>

                                                <button
                                                    className="btn btn-dark btn-lg mr-4"
                                                    disabled={
                                                        !order.next_page_url
                                                    }
                                                    onClick={() =>
                                                        setPage(page + 1)
                                                    }
                                                >
                                                    <i className="fa fa-arrow-right"></i>
                                                </button>
                                            </div>
                                        </>
                                    )}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
};

export default Order;
