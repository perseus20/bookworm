import React from "react";
import { Routes, Route } from "react-router-dom";
import Header from "./../layout/header";
import Footer from "../layout/footer";
import HomePage from "./homepage";
import ShopPage from "./shoppage";
export default function BookWorm() {
    return (
        <>
            <Header />
            <Footer />
        </>
    );
}
