import React from "react";
import { Link, useLocation } from "react-router-dom";

const Nav = () => {
    const { pathname } = useLocation();
    return (
        <div className="account__left--sidebar">
            <h2 className="account__content--title mb-20">My Profile</h2>
            <ul className="account__menu">
                <li
                    className={`account__menu--list ${
                        pathname === "/" ? "active" : ""
                    }`}
                >
                    <Link to={"/"}>Cart Lists</Link>
                </li>

                <li
                    className={`account__menu--list ${
                        pathname === "/order" ? "active" : ""
                    }`}
                >
                    <Link to={"/order"}>Order Lists</Link>
                </li>

                <li
                    className={`account__menu--list ${
                        pathname === "/profile" ? "active" : ""
                    }`}
                >
                    <Link to={"/profile"}>My Profile</Link>
                </li>
                <li
                    className={`account__menu--list ${
                        pathname === "/password" ? "active" : ""
                    }`}
                >
                    <Link to={"/password"}>Change Password</Link>
                </li>
            </ul>
        </div>
    );
};

export default Nav;
