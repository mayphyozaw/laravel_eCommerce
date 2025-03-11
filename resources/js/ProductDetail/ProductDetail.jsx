import React, { useEffect, useState } from "react";
import Review from "./Component/Review";
import axios from "axios";
import Spinner from "../Component/Spinner";
import SmallSpinner from "../Component/SmallSpinner";

export default function ProductDetail() {
    const [product, setProduct] = useState([]);
    const [loader, setLoader] = useState(true);
    const product_slug = window.product_slug;
    const [cartLoader, setCartLoader] = useState(false);

    useEffect(() => {
        axios.get("/api/product/" + product_slug).then(({ data }) => {
            setProduct(data.data);
            setLoader(false);
        });
    }, []);

    // ## Add to Cart
    const addToCart = () => {
        setCartLoader(true);
        const user_id = window.auth.id;
        axios.post("/api/addToCart", { user_id, product_slug }).then((d) => {
            const { data } = d;
            if (data.false) {
                setCartLoader(false);
                showToast("Product Not Found");
            } else {
                window.updateCart(data.data);
                showToast("Product Added to Cart");
                setCartLoader(false);
            }
        });
    };

    return (
        <>
            {loader && <Spinner />}
            {!loader && (
                <div className="col-xl-9 col-lg-8">
                    <div className="product__details--sidebar__wrapper position__sticky">
                        <div className="product__sidebar--wrapper__top section--padding pt-0">
                            <div className="row">
                                <div className="col-xl-6 col-lg-12 col-md-6">
                                    <div className="product__details--media details__media--position">
                                        <div className="single__product--nav swiper">
                                            <div className="swiper-wrapper">
                                                <div className="swiper-slide">
                                                    <div className="product__media--nav__items">
                                                        <img
                                                            className="product__media--nav__items--img"
                                                            src={
                                                                product.image_url
                                                            }
                                                            alt="product-nav-img"
                                                        />
                                                    </div>
                                                </div>
                                                <div className="swiper-slide">
                                                    <div className="product__media--nav__items">
                                                        <img
                                                            className="product__media--nav__items--img"
                                                            src={
                                                                product.image_url
                                                            }
                                                            alt="product-nav-img"
                                                        />
                                                    </div>
                                                </div>
                                                <div className="swiper-slide">
                                                    <div className="product__media--nav__items">
                                                        <img
                                                            className="product__media--nav__items--img"
                                                            src={
                                                                product.image_url
                                                            }
                                                            alt="product-nav-img"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div className="col-xl-6 col-lg-12 col-md-6">
                                    <div className="product__details--info style2">
                                        <form action="#">
                                            <h2 className="product__details--info__title mb-15">
                                                {product.name}
                                            </h2>
                                            <small className="info__list--item-head text-mute">
                                                {" "}
                                                Category:{" "}
                                            </small>
                                            <small className="badge badge-dark">
                                                {product.category.name}
                                            </small>
                                            <br />
                                            <small className="info__list--item-head">
                                                <strong>
                                                    Brand : {product.brand.name}
                                                </strong>
                                            </small>

                                            <div className="product__details--info__price mb-12">
                                                <span className="current__price">
                                                    {product.sale_price} ks
                                                </span>
                                                <span className="old__price text-muted">
                                                    {product.discount_price} ks
                                                </span>
                                            </div>
                                            <ul className="rating product__card--rating mb-15 d-flex">
                                                <li className="rating__list">
                                                    <span className="rating__icon">
                                                        <svg
                                                            width={14}
                                                            height={13}
                                                            viewBox="0 0 14 13"
                                                            fill="none"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                        >
                                                            <path
                                                                d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z"
                                                                fill="currentColor"
                                                            />
                                                        </svg>
                                                    </span>
                                                </li>
                                                <li className="rating__list">
                                                    <span className="rating__icon">
                                                        <svg
                                                            width={14}
                                                            height={13}
                                                            viewBox="0 0 14 13"
                                                            fill="none"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                        >
                                                            <path
                                                                d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z"
                                                                fill="currentColor"
                                                            />
                                                        </svg>
                                                    </span>
                                                </li>
                                                <li className="rating__list">
                                                    <span className="rating__icon">
                                                        <svg
                                                            width={14}
                                                            height={13}
                                                            viewBox="0 0 14 13"
                                                            fill="none"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                        >
                                                            <path
                                                                d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z"
                                                                fill="currentColor"
                                                            />
                                                        </svg>
                                                    </span>
                                                </li>
                                                <li className="rating__list">
                                                    <span className="rating__icon">
                                                        <svg
                                                            width={14}
                                                            height={13}
                                                            viewBox="0 0 14 13"
                                                            fill="none"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                        >
                                                            <path
                                                                d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z"
                                                                fill="currentColor"
                                                            />
                                                        </svg>
                                                    </span>
                                                </li>
                                                <li className="rating__list">
                                                    <span className="rating__icon">
                                                        <svg
                                                            width={14}
                                                            height={13}
                                                            viewBox="0 0 14 13"
                                                            fill="none"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                        >
                                                            <path
                                                                d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z"
                                                                fill="currentColor"
                                                            />
                                                        </svg>
                                                    </span>
                                                </li>
                                            </ul>
                                            <p
                                                className="product__details--info__desc mb-15"
                                                dangerouslySetInnerHTML={{
                                                    __html: product.description,
                                                }}
                                            ></p>

                                            <small className="info__list--item-head">
                                                Color :{" "}
                                            </small>

                                            {product.color.map((d) => {
                                                return (
                                                    <span
                                                        className="badge badge-danger "
                                                        key={d.id}
                                                        style={{
                                                            marginRight: "10px",
                                                        }}
                                                    >
                                                        {d.name}
                                                    </span>
                                                );
                                            })}

                                            <hr />

                                            {/*  */}
                                            <div className="product__variant">
                                                <div className="product__variant--list quantity d-flex align-items-center mb-20">
                                                    <span className="btn btn-sm btn-outline-success text-success">
                                                        Instock:{" "}
                                                        {product.total_qty}
                                                    </span>

                                                    <button
                                                        className="primary__btn quickview__cart--btn"
                                                        type="submit"
                                                        onClick={() =>
                                                            addToCart()
                                                        }
                                                        disabled={cartLoader}
                                                    >
                                                        {cartLoader && (
                                                            <SmallSpinner />
                                                        )}
                                                        Add To Cart
                                                    </button>
                                                </div>

                                                <div className="product__variant--list mb-20">
                                                    <a
                                                        className="variant__wishlist--icon mb-15"
                                                        href=""
                                                        title="Add to wishlist"
                                                    >
                                                        <svg
                                                            className="quickview__variant--wishlist__svg"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 512 512"
                                                        >
                                                            <path
                                                                d="M352.92 80C288 80 256 144 256 144s-32-64-96.92-64c-52.76 0-94.54 44.14-95.08 96.81-1.1 109.33 86.73 187.08 183 252.42a16 16 0 0018 0c96.26-65.34 184.09-143.09 183-252.42-.54-52.67-42.32-96.81-95.08-96.81z"
                                                                fill="none"
                                                                stroke="currentColor"
                                                                strokeLinecap="round"
                                                                strokeLinejoin="round"
                                                                strokeWidth={32}
                                                            />
                                                        </svg>
                                                        Add to Wishlist
                                                    </a>
                                                    <button
                                                        className="variant__buy--now__btn primary__btn"
                                                        type="submit"
                                                    >
                                                        Buy it now
                                                    </button>
                                                </div>
                                            </div>

                                            {/* social share */}
                                            <div className="quickview__social d-flex align-items-center mb-20">
                                                <label className="quickview__social--title">
                                                    Social Share:
                                                </label>
                                                <ul className="quickview__social--wrapper mt-0 d-flex">
                                                    <li className="quickview__social--list">
                                                        <a
                                                            className="quickview__social--icon"
                                                            target="_blank"
                                                            href="https://www.facebook.com/"
                                                        >
                                                            <svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                width="7.667"
                                                                height="16.524"
                                                                viewBox="0 0 7.667 16.524"
                                                            >
                                                                <path
                                                                    data-name="Path 237"
                                                                    d="M967.495,353.678h-2.3v8.253h-3.437v-8.253H960.13V350.77h1.624v-1.888a4.087,4.087,0,0,1,.264-1.492,2.9,2.9,0,0,1,1.039-1.379,3.626,3.626,0,0,1,2.153-.6l2.549.019v2.833h-1.851a.732.732,0,0,0-.472.151.8.8,0,0,0-.246.642v1.719H967.8Z"
                                                                    transform="translate(-960.13 -345.407)"
                                                                    fill="currentColor"
                                                                />
                                                            </svg>
                                                            <span className="visually-hidden">
                                                                Facebook
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li className="quickview__social--list">
                                                        <a
                                                            className="quickview__social--icon"
                                                            target="_blank"
                                                            href="https://twitter.com/"
                                                        >
                                                            <svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                width="16.489"
                                                                height="13.384"
                                                                viewBox="0 0 16.489 13.384"
                                                            >
                                                                <path
                                                                    data-name="Path 303"
                                                                    d="M966.025,1144.2v.433a9.783,9.783,0,0,1-.621,3.388,10.1,10.1,0,0,1-1.845,3.087,9.153,9.153,0,0,1-3.012,2.259,9.825,9.825,0,0,1-4.122.866,9.632,9.632,0,0,1-2.748-.4,9.346,9.346,0,0,1-2.447-1.11q.4.038.809.038a6.723,6.723,0,0,0,2.24-.376,7.022,7.022,0,0,0,1.958-1.054,3.379,3.379,0,0,1-1.958-.687,3.259,3.259,0,0,1-1.186-1.666,3.364,3.364,0,0,0,.621.056,3.488,3.488,0,0,0,.885-.113,3.267,3.267,0,0,1-1.374-.631,3.356,3.356,0,0,1-.969-1.186,3.524,3.524,0,0,1-.367-1.5v-.057a3.172,3.172,0,0,0,1.544.433,3.407,3.407,0,0,1-1.1-1.214,3.308,3.308,0,0,1-.4-1.609,3.362,3.362,0,0,1,.452-1.694,9.652,9.652,0,0,0,6.964,3.538,3.911,3.911,0,0,1-.075-.772,3.293,3.293,0,0,1,.452-1.694,3.409,3.409,0,0,1,1.233-1.233,3.257,3.257,0,0,1,1.685-.461,3.351,3.351,0,0,1,2.466,1.073,6.572,6.572,0,0,0,2.146-.828,3.272,3.272,0,0,1-.574,1.083,3.477,3.477,0,0,1-.913.8,6.869,6.869,0,0,0,1.958-.546A7.074,7.074,0,0,1,966.025,1144.2Z"
                                                                    transform="translate(-951.23 -1140.849)"
                                                                    fill="currentColor"
                                                                />
                                                            </svg>
                                                            <span className="visually-hidden">
                                                                Twitter
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li className="quickview__social--list">
                                                        <a
                                                            className="quickview__social--icon"
                                                            target="_blank"
                                                            href="https://www.instagram.com/"
                                                        >
                                                            <svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                width="17.497"
                                                                height="17.492"
                                                                viewBox="0 0 19.497 19.492"
                                                            >
                                                                <path
                                                                    data-name="Icon awesome-instagram"
                                                                    d="M9.747,6.24a5,5,0,1,0,5,5A4.99,4.99,0,0,0,9.747,6.24Zm0,8.247A3.249,3.249,0,1,1,13,11.238a3.255,3.255,0,0,1-3.249,3.249Zm6.368-8.451A1.166,1.166,0,1,1,14.949,4.87,1.163,1.163,0,0,1,16.115,6.036Zm3.31,1.183A5.769,5.769,0,0,0,17.85,3.135,5.807,5.807,0,0,0,13.766,1.56c-1.609-.091-6.433-.091-8.042,0A5.8,5.8,0,0,0,1.64,3.13,5.788,5.788,0,0,0,.065,7.215c-.091,1.609-.091,6.433,0,8.042A5.769,5.769,0,0,0,1.64,19.341a5.814,5.814,0,0,0,4.084,1.575c1.609.091,6.433.091,8.042,0a5.769,5.769,0,0,0,4.084-1.575,5.807,5.807,0,0,0,1.575-4.084c.091-1.609.091-6.429,0-8.038Zm-2.079,9.765a3.289,3.289,0,0,1-1.853,1.853c-1.283.509-4.328.391-5.746.391S5.28,19.341,4,18.837a3.289,3.289,0,0,1-1.853-1.853c-.509-1.283-.391-4.328-.391-5.746s-.113-4.467.391-5.746A3.289,3.289,0,0,1,4,3.639c1.283-.509,4.328-.391,5.746-.391s4.467-.113,5.746.391a3.289,3.289,0,0,1,1.853,1.853c.509,1.283.391,4.328.391,5.746S17.855,15.705,17.346,16.984Z"
                                                                    transform="translate(0.004 -1.492)"
                                                                    fill="currentColor"
                                                                />
                                                            </svg>
                                                            <span className="visually-hidden">
                                                                Instagram
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li className="quickview__social--list">
                                                        <a
                                                            className="quickview__social--icon"
                                                            target="_blank"
                                                            href="https://www.youtube.com/"
                                                        >
                                                            <svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                width="16.49"
                                                                height="11.582"
                                                                viewBox="0 0 16.49 11.582"
                                                            >
                                                                <path
                                                                    data-name="Path 321"
                                                                    d="M967.759,1365.592q0,1.377-.019,1.717-.076,1.114-.151,1.622a3.981,3.981,0,0,1-.245.925,1.847,1.847,0,0,1-.453.717,2.171,2.171,0,0,1-1.151.6q-3.585.265-7.641.189-2.377-.038-3.387-.085a11.337,11.337,0,0,1-1.5-.142,2.206,2.206,0,0,1-1.113-.585,2.562,2.562,0,0,1-.528-1.037,3.523,3.523,0,0,1-.141-.585c-.032-.2-.06-.5-.085-.906a38.894,38.894,0,0,1,0-4.867l.113-.925a4.382,4.382,0,0,1,.208-.906,2.069,2.069,0,0,1,.491-.755,2.409,2.409,0,0,1,1.113-.566,19.2,19.2,0,0,1,2.292-.151q1.82-.056,3.953-.056t3.952.066q1.821.067,2.311.142a2.3,2.3,0,0,1,.726.283,1.865,1.865,0,0,1,.557.49,3.425,3.425,0,0,1,.434,1.019,5.72,5.72,0,0,1,.189,1.075q0,.095.057,1C967.752,1364.1,967.759,1364.677,967.759,1365.592Zm-7.6.925q1.49-.754,2.113-1.094l-4.434-2.339v4.66Q958.609,1367.311,960.156,1366.517Z"
                                                                    transform="translate(-951.269 -1359.8)"
                                                                    fill="currentColor"
                                                                />
                                                            </svg>
                                                            <span className="visually-hidden">
                                                                Youtube
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>

                                            {/* payment type */}
                                            <div className="guarantee__safe--checkout mb-30">
                                                <h5 className="guarantee__safe--checkout__title">
                                                    Guaranteed Safe Checkout
                                                </h5>
                                                <img
                                                    className="guarantee__safe--checkout__img"
                                                    src="/web_assets/assets/img/other/safe-checkout.webp"
                                                    alt="Payment Image"
                                                />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr />
                        <Review review={product.review} />
                    </div>
                </div>
            )}
        </>
    );
}
