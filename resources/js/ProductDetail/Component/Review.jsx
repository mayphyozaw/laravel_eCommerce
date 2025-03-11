import axios from "axios";
import React, { useState } from "react";
import { Rating } from "react-simple-star-rating";
import Spinner from "../../Component/Spinner";

const Review = ({ review }) => {
    const [reviewList, setReviewList] = useState(review);
    const [rating, setRating] = useState(0);
    const [comment, setComment] = useState("");
    const [loader, setLoader] = useState(false);

    const handleRating = (rate) => {
        setRating(rate);
    };
    const disableReview = rating && comment !== "" ? false : true;

    const makeReview = () => {
        const user_id = window.auth.id;
        const slug = window.product_slug;
        const data = { comment, user_id, slug, rating };
        axios.post("/api/make-review/" + slug, data).then(({ data }) => {
            if (data.message === false) {
                showToast("Product Not Found");
            } else {
                setReviewList([...reviewList, data.data]);
                setLoader(false);
                setComment("");
                setRating(0);
            }
        });
    };

    return (
        <div className="product__reviews">
            <div className="product__reviews--header">
                <h2 className="product__reviews--header__title h3 mb-20">
                    Customer Reviews
                </h2>
            </div>

            {reviewList.map((d) => (
                <div key={d.id} className="reviews__comment--area">
                    <div
                        className="reviews__comment--list d-flex"
                        style={{
                            borderBottom: "1px solid var(--border-color)",
                            paddingBottom: "2rem",
                            marginBottom: "2rem",
                        }}
                    >
                        <div className="reviews__comment--thumb">
                            <img src={d.user.image_url} alt="comment-thumb" />
                        </div>
                        <div className="reviews__comment--content">
                            <div className="reviews__comment--top d-flex justify-content-between">
                                <div className="reviews__comment--top__left">
                                    <h2 className="reviews__comment--content__title h2">
                                        {d.user.name}
                                    </h2>
                                    <Rating
                                        initialValue={d.rating}
                                        readonly={true}
                                        size={20}
                                    />
                                </div>
                            </div>
                            <p className="reviews__comment--content__desc">
                                {d.review}
                            </p>
                        </div>
                    </div>
                </div>
            ))}

            {window.auth && (
                <div
                    id="writereview"
                    className="reviews__comment--reply__area mt-20"
                >
                    {loader && <Spinner />}
                    {!loader && (
                        <>
                            <h2 className="reviews__comment--reply__title mb-15">
                                Make a review{" "}
                            </h2>
                            {/* rating component */}
                            <div className="reviews__ratting mb-20">
                                <Rating
                                    onClick={handleRating}
                                    initialValue={rating}
                                />
                            </div>
                            <div className="row">
                                <div className="col-12 mb-10">
                                    <textarea
                                        className="reviews__comment--reply__textarea"
                                        placeholder="Enter review"
                                        value={comment}
                                        onChange={(e) =>
                                            setComment(e.target.value)
                                        }
                                    />
                                </div>
                            </div>
                            <button
                                type="button"
                                className="btn btn-dark"
                                disabled={disableReview}
                                onClick={() => makeReview()}
                            >
                                Review
                            </button>
                        </>
                    )}
                </div>
            )}
        </div>
    );
};
export default Review;
