import axios from "axios";
import React, { useEffect, useState } from "react";
import Nav from "./Component/Nav";

const Profile = () => {
    const [profile, setProfile] = useState({});
    const [phone, setPhone] = useState("");
    const [address, setAddress] = useState("");
    const [loader, setLoader] = useState(false);
    const [showForm, setShowForm] = useState(false);

    const user_id = window.auth.id;

    useEffect(() => {
        fetchProfile();
    }, [user_id]);

    const fetchProfile = async () => {
        try {
            const response = await axios.get(`/api/profile?user_id=${user_id}`);
            setProfile(response.data.data);
        } catch (error) {
            console.error("Error fetching profile:", error);
        }
    };

    const editProfile = () => {
        setLoader(true);

        axios
            .post(`/api/editProfile?user_id=${user_id}`, {
                phone,
                address,
            })
            .then((d) => {
                setLoader(false);
                const { data } = d;
                if (data.message === false) {
                    showToast(
                        "PhoneNumber and Address has already existed",
                        "error"
                    );
                } else {
                    showToast("Profile change successfully", "success");
                    setPhone("");
                    setAddress("");
                    fetchProfile();
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
                            <h2 className="account__content--title h2 mb-10">
                                My Account
                            </h2>
                            <hr />
                            <div className="container">
                                <div className="row">
                                    <div className="col-lg-6">
                                        <img
                                            src={profile.image_url}
                                            alt=""
                                            width={80}
                                            style={{
                                                borderRadius: "50%",
                                                padding: "4px",
                                                border: "3px solid #c97f5f",
                                            }}
                                        />
                                        <h4
                                            style={{
                                                fontSize: "14px",
                                                fontWeight: "bold",
                                                padding: "4px",
                                            }}
                                        >
                                            {profile.name}
                                        </h4>

                                        <h4
                                            style={{
                                                fontSize: "14px",
                                                padding: "2px",
                                            }}
                                        >
                                            {profile.email}
                                        </h4>

                                        <h4
                                            style={{
                                                fontSize: "14px",
                                                fontWeight: "bold",
                                                padding: "4px",
                                            }}
                                        >
                                            {profile.phone}
                                        </h4>

                                        <h4
                                            style={{
                                                fontSize: "14px",
                                                fontWeight: "bold",
                                                padding: "4px",
                                            }}
                                        >
                                            {profile.address}
                                        </h4>

                                        <div className="continue__shopping d-flex justify-content-start">
                                            <button
                                                className="cart__summary--footer__btn primary__btn checkout"
                                                type="button"
                                                onClick={() =>
                                                    setShowForm(true)
                                                }
                                            >
                                                Edit Address
                                            </button>
                                        </div>
                                    </div>

                                    {showForm && (
                                        <div className="col-lg-6">
                                            <div className="account__login--inner">
                                                <label
                                                    style={{
                                                        display: "block",
                                                        fontSize: "14px",
                                                    }}
                                                >
                                                    Enter Phone Number
                                                    <input
                                                        style={{
                                                            height: "30px",
                                                        }}
                                                        className="account__login--input"
                                                        type="text"
                                                        value={phone}
                                                        onChange={(e) =>
                                                            setPhone(
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
                                                >
                                                    Enter Address
                                                    <input
                                                        style={{
                                                            height: "30px",
                                                        }}
                                                        className="account__login--input"
                                                        type="text"
                                                        value={address}
                                                        onChange={(e) =>
                                                            setAddress(
                                                                e.target.value
                                                            )
                                                        }
                                                    />
                                                </label>

                                                <button
                                                    className="login--btn primary__btn"
                                                    onClick={editProfile}
                                                    disabled={loader}
                                                >
                                                    {loader
                                                        ? "Saving..."
                                                        : "Change"}
                                                </button>
                                            </div>
                                        </div>
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

export default Profile;
