import React, { useState } from "react";
import SmallSpinner from "../Component/SmallSpinner";
import axios from "axios";

const ChangePassword = () => {
    const [currentPassword, setCurrentPassword] = useState("");
    const [newPassword, setNewPassword] = useState("");
    const [confirmPassword, setConfirmPassword] = useState("");
    const [loader, setLoader] = useState(false);

    const changePassword = () => {
        setLoader(true);
        if (newPassword !== confirmPassword) {
            showToast("Wrong Confirmation Password", "error");
        } else {
            // const user_id = window.auth.id;
            // const data = { user_id, currentPassword, newPassword };
            axios
                .post("/api/changePassword?user_id=" + window.auth.id, {
                    currentPassword,
                    newPassword,
                })
                .then((d) => {
                    setLoader(false);
                    const { data } = d;
                    if (data.message === false) {
                        showToast("Wrong Current Password", "error");
                    } else {
                        showToast(
                            "Password change successfully, user your new password at next login time."
                        );
                    }
                });
        }
    };
    return (
        <div className="login__section section--padding">
            <div className="container">
                <div className="login__section--inner">
                    <div className="row row-cols-md-2 row-cols-1 justify-content-center">
                        <div className="col">
                            <div className="account__login register">
                                <div className="account__login--header mb-25 text-center">
                                    <h2 className="account__login--header__title mb-15">
                                        Change Password
                                    </h2>
                                </div>

                                <div className="account__login--inner">
                                    <label
                                        style={{
                                            display: "block",
                                            fontSize: "14px",
                                        }}
                                        htmlFor
                                    >
                                        Enter Current Password
                                        <input
                                            style={{
                                                height: "30px",
                                            }}
                                            className="account__login--input"
                                            type="password"
                                            onChange={(e) =>
                                                setCurrentPassword(
                                                    e.target.value
                                                )
                                            }
                                        />
                                    </label>
                                    <label
                                        style={{
                                            display: "block",
                                            fontSize: "14px",
                                        }}
                                        htmlFor
                                    >
                                        Enter New Password
                                        <input
                                            style={{
                                                height: "30px",
                                            }}
                                            className="account__login--input"
                                            type="password"
                                            onChange={(e) =>
                                                setNewPassword(e.target.value)
                                            }
                                        />
                                    </label>
                                    <label
                                        style={{
                                            display: "block",
                                            fontSize: "14px",
                                        }}
                                        htmlFor
                                    >
                                        Confirm New Password
                                        <input
                                            style={{
                                                height: "30px",
                                            }}
                                            className="account__login--input"
                                            type="password"
                                            onChange={(e) =>
                                                setConfirmPassword(
                                                    e.target.value
                                                )
                                            }
                                        />
                                    </label>
                                    <button
                                        className="login--btn primary__btn"
                                        onClick={() => changePassword()}
                                    >
                                        {loader && <SmallSpinner />}
                                        Change
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default ChangePassword;
