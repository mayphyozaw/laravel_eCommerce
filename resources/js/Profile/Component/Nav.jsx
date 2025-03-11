import React from "react";
import { Link, useLocation } from "react-router-dom";

const Nav = () => {
    const { pathname } = useLocation();
    console.log(pathname);
    return (
        <div className="container-fluid mt-3">
            <div className="card p-3 bg-dark flex flex-wrap gap-4 text-center ">
                <div>
                    <Link
                        to={"/"}
                        className={`btn btn${
                            pathname === "/" ? "" : "-outline"
                        }-warning mr-4`}
                        style={{ fontSize: 14 }}
                    >
                        Cart Lists
                    </Link>
                    <Link
                        to={"/order"}
                        className={`btn btn${
                            pathname === "/order" ? "" : "-outline"
                        }-warning mr-4`}
                        style={{ fontSize: 14 }}
                    >
                        Order Lists
                    </Link>
                    <Link
                        to={"/profile"}
                        className={`btn btn${
                            pathname === "/profile" ? "" : "-outline"
                        }-warning mr-4`}
                        style={{ fontSize: 14 }}
                    >
                        Profile Lists
                    </Link>
                    <Link
                        to={"/password"}
                        className={`btn btn${
                            pathname === "/password" ? "" : "-outline"
                        }-warning mr-4`}
                        style={{ fontSize: 14 }}
                    >
                        Change Password
                    </Link>
                </div>
            </div>
        </div>
    );
};

export default Nav;
