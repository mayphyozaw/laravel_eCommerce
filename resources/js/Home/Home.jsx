import axios from "axios";
import React, { useEffect, useState } from "react";
import Spinner from "../Component/Spinner";
import { Swiper, SwiperSlide } from "swiper/react";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import { Navigation, Pagination } from "swiper/modules";

export default function Home() {
    const [category, setCategory] = useState([]);
    const [featureProduct, setFeatureProduct] = useState([]);
    const [productByCategory, setProductByCategory] = useState([]);
    const [loader, setLoader] = useState(true);

    const fetchProduct = () => {
        axios.get("/api/home").then((d) => {
            const { category, featureProduct, productByCategory } = d.data.data;
            setCategory(category);
            setFeatureProduct(featureProduct);
            setProductByCategory(productByCategory);
            setLoader(false);
        });
    };

    useEffect(() => {
        fetchProduct();
    }, []);

    console.log("Feature Product", featureProduct);

    return (
        <>
            {loader && <Spinner />}
            {!loader && (
                <div>
                    <section className="shop__collection--section section--padding">
                        <div className="container">
                            <div className="section__heading text-center mb-40">
                                <h2 className="section__heading--maintitle">
                                    Shop By Category
                                </h2>
                            </div>
                            <div className="shop__collection--column5 swiper">
                                <Swiper
                                    modules={[Navigation, Pagination]}
                                    spaceBetween={30}
                                    slidesPerView={1}
                                    breakpoints={{
                                        576: { slidesPerView: 3 },
                                        768: { slidesPerView: 4 },
                                        992: { slidesPerView: 5 },
                                    }}
                                    navigation={{
                                        nextEl: ".swiper-button-next",
                                        prevEl: ".swiper-button-prev",
                                    }}
                                    pagination={{ clickable: true }}
                                >
                                    {category.map((d) => (
                                        <SwiperSlide key={d.slug}>
                                            <div className="shop__collection--card text-center border">
                                                <a
                                                    className="shop__collection--link"
                                                    href={`/product?category=${d.slug}`}
                                                >
                                                    <img
                                                        className="shop__collection--img"
                                                        src={d.image_url}
                                                        alt="icon-img"
                                                    />
                                                </a>
                                            </div>
                                            <h3 className="shop__collection--title mb-0 text-center">
                                                {window.locale === "mm"
                                                    ? d.mm_name
                                                    : d.name}
                                            </h3>
                                            <small
                                                className="shop__collection--title mb-0 text-center"
                                                hidden
                                            >
                                                {" "}
                                                {d.product_count}items
                                            </small>
                                        </SwiperSlide>
                                    ))}
                                </Swiper>
                                <>
                                    <div className="swiper__nav--btn swiper-button-next">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width={24}
                                            height={24}
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            strokeWidth={2}
                                            strokeLinecap="round"
                                            strokeLinejoin="round"
                                            className=" -chevron-right"
                                        >
                                            <polyline points="9 18 15 12 9 6" />
                                        </svg>
                                    </div>
                                    <div className="swiper__nav--btn swiper-button-prev">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width={24}
                                            height={24}
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            strokeWidth={2}
                                            strokeLinecap="round"
                                            strokeLinejoin="round"
                                            className=" -chevron-left"
                                        >
                                            <polyline points="15 18 9 12 15 6" />
                                        </svg>
                                    </div>
                                </>
                            </div>
                        </div>
                    </section>
                </div>
            )}

            <section className="product__section section--padding">
                <div className="container">
                    <div className="row">
                        <div className="section__heading text-center mb-40">
                            <h2 className="section__heading--maintitle">
                                Trending Product
                            </h2>
                        </div>
                        <div className="col-lg-3 col-md-3" hidden>
                            {featureProduct.map((d) => (
                                <div
                                    className="col-lg-12 col-md-12 col-sm-12 col-12 mb-20"
                                    key={d.slug}
                                >
                                    <article className="product__card">
                                        <div className="product__card--thumbnail">
                                            <a
                                                className="product__card--thumbnail__link "
                                                href=""
                                            >
                                                <img
                                                    className="product__card--thumbnail__img product__primary--img"
                                                    src={d.image_url}
                                                    width={20}
                                                    alt="product-img"
                                                />
                                                <img
                                                    className="product__card--thumbnail__img product__secondary--img"
                                                    src={d.image_url}
                                                    alt="product-img"
                                                />
                                            </a>
                                        </div>
                                        <div className="product__card--content text-center">
                                            <h3 className="product__card--title">
                                                <a href={`/product/${d.slug}`}>
                                                    {d.name}{" "}
                                                </a>
                                            </h3>
                                            <div className="product__card--price">
                                                <span className="current__price">
                                                    ${d.sale_price}
                                                </span>
                                                <span className="old__price">
                                                    {" "}
                                                    ${d.discount_price}
                                                </span>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            ))}
                        </div>

                        <div className="col-md-12">
                            {productByCategory.map((d) => (
                                <div className="col-md-12 mb-10">
                                    <div className="row d-flex justify-content-between">
                                        <div className="col-md-3 d-flex align-items-center">
                                            <h2>{d.name}</h2>
                                        </div>
                                    </div>

                                    <div className="row pt-3">
                                        {d.product.map((d) => (
                                            <div
                                                className="col-lg-3 col-md-3 col-sm-12 col-12 text-center"
                                                key={d.slug}
                                            >
                                                <article className="product__card">
                                                    <div className="product__card--thumbnail">
                                                        <a
                                                            className="product__card--thumbnail__link display-block"
                                                            href={`/product/${d.slug}`}
                                                        >
                                                            <img
                                                                className="product__card--thumbnail__img"
                                                                src={
                                                                    d.image_url
                                                                }
                                                                alt="product-img"
                                                                style={{
                                                                    width: "100%",
                                                                    height: "200px",
                                                                    backgroundSize:
                                                                        "contain",
                                                                    objectFit:
                                                                        "contain",
                                                                    objectPosition:
                                                                        "contain",
                                                                }}
                                                            />
                                                        </a>
                                                    </div>

                                                    <div className="product__card--content text-center">
                                                        <ul className="rating product__card--rating d-flex justify-content-center"></ul>
                                                        <h3 className="product__card--title">
                                                            <a
                                                                href={`/product?category=${d.slug}`}
                                                            >
                                                                {d.name}{" "}
                                                            </a>
                                                        </h3>
                                                        <div className="product__card--price">
                                                            <span className="current__price">
                                                                ${d.sale_price}
                                                            </span>
                                                            <br />
                                                            <span className="old__price">
                                                                {" "}
                                                                $
                                                                {
                                                                    d.discount_price
                                                                }
                                                            </span>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                        ))}
                                    </div>

                                    <div className="row pt-5 py-3">
                                        <div className="col-md-12 d-flex justify-content-center">
                                            <a
                                                className="load__more--btn primary__btn"
                                                href={`/product?category=${d.slug}`}
                                            >
                                                View All
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            </section>
        </>
    );
}
