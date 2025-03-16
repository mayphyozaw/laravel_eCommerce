import React from "react";
import { createRoot } from "react-dom/client";
import { HashRouter, Link, Route, Routes } from "react-router-dom";
import CartList from "./Profile/CartList";
import Order from "./Profile/Order";
import Profile from "./Profile/Profile";
import Nav from "./Profile/Component/Nav";
import ChangePassword from "./Profile/ChangePassword";
const MainRouter = () => {
    return (
        <HashRouter>
            {/* <Nav /> */}
            <Routes>
                <Route path="/" element={<CartList />} />
                <Route path="/order" element={<Order />} />
                <Route path="/profile" element={<Profile />} />
                <Route path="/password" element={<ChangePassword />} />
            </Routes>
        </HashRouter>
    );
};

createRoot(document.getElementById("root")).render(<MainRouter />);
