import axios from "axios";
import React, { useEffect, useState } from "react";

const Profile = () => {
    const [profile, setProfile] = useState("");
    const user_id = window.auth.id;
    useEffect(() => {
        axios.get("/api/profile?user_id=" + user_id).then((d) => {
            const { data } = d;
            setProfile(data.data);
        });
    }, []);
    return (
        <div className="login__section section--padding">
            <div className="container">
                <div className="login__section--inner">
                    <div className="row row-cols-md-2 row-cols-1 justify-content-center">
                        <div className="col">
                            <div className="account__login register">
                                <div className="account__login--header mb-25 text-center">
                                    <h2 className="account__login--header__title mb-15">
                                        Profile Info
                                    </h2>
                                </div>

                                <div>
                                    <div className="form-group row">
                                        <label
                                            htmlFor="inputEmail3"
                                            className="col-sm-2 col-form-label"
                                            style={{ fontSize: 14 }}
                                        >
                                            Name
                                        </label>
                                        <div className="col-sm-10">
                                            <input
                                                style={{ fontSize: 14 }}
                                                type="text"
                                                name="name"
                                                className="form-control"
                                                value={profile.name}
                                            />
                                        </div>
                                    </div>
                                    <div className="form-group row">
                                        <label
                                            htmlFor="inputPassword3"
                                            className="col-sm-2 col-form-label"
                                            style={{ fontSize: 14 }}
                                        >
                                            Phone
                                        </label>
                                        <div className="col-sm-10">
                                            <input
                                                style={{ fontSize: 14 }}
                                                type="number"
                                                className="form-control"
                                                value={profile.phone}
                                            />
                                        </div>
                                    </div>
                                    <div className="form-group row">
                                        <label
                                            htmlFor="inputPassword3"
                                            className="col-sm-2 col-form-label"
                                            style={{ fontSize: 14 }}
                                        >
                                            Address
                                        </label>
                                        <div className="col-sm-10">
                                            <input
                                                style={{ fontSize: 14 }}
                                                type="text"
                                                className="form-control"
                                                value={profile.address}
                                            />
                                        </div>
                                    </div>
                                    <button className="btn btn-primary">
                                        Update
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

export default Profile;
