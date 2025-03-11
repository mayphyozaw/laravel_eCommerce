import axios from "axios";
import React, { useEffect, useState } from "react";
import Spinner from "../Component/Spinner";

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
        <div>
            {loader && <Spinner />}
            {!loader && (
                <>
                    <table className="table table-stripe">
                        <thead>
                            <tr style={{ fontSize: 16 }}>
                                <th style={{ width: 20 }}>Image</th>
                                <th style={{ width: 10 }}>Name</th>
                                <th style={{ width: 5 }}>Quantity</th>
                                <th style={{ width: 10 }}>Price</th>
                                <th style={{ width: 10 }}>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            {order.data.map((d) => (
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
                                    <td style={{ fontSize: 18 }}>
                                        {d.status === "cancel" && (
                                            <span class="badge badge-danger">
                                                <h1>Cancel</h1>
                                            </span>
                                        )}

                                        {d.status === "success" && (
                                            <span className="badge badge-success">
                                                Success
                                            </span>
                                        )}

                                        {d.status === "pending" && (
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
                                order.prev_page_url === null ? true : false
                            }
                            onClick={() => setPage((page = 1))}
                        >
                            <i className="fas fa-arrow-left"></i>
                        </button>
                        <button
                            className="btn btn-dark btn-lg mr-4"
                            disabled={
                                order.next_page_url === null ? true : false
                            }
                            onClick={() => setPage(page + 1)}
                        >
                            <i className="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </>
            )}
        </div>
    );
};

export default Order;
