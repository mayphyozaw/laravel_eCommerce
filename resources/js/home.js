import React from "react";
import { createRoot } from "react-dom/client";
import { HashRouter, Link, Route, Routes } from "react-router-dom";
import Home from "./Home/Home";
import About from "./Home/About";

const MainRouter = () => {
    return (
        <HashRouter>
            <Link to={"/"}>Home</Link>
            <Link to={"/about"}>About</Link>
            <Routes>
                <Route path="/" element={<Home />} />
                <Route path="/about" element={<About />} />
            </Routes>
        </HashRouter>
    );
};

createRoot(document.querySelector("#root")).render(<MainRouter />);
