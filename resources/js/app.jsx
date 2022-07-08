import React from "react";
import ReactDOM from "react-dom";
import "bootstrap/dist/css/bootstrap.min.css";
import { BrowserRouter } from "react-router-dom";
import Welcome from "./welcome";
import BookWorm from "./components/bookworm";

ReactDOM.render(
    <BrowserRouter>
        <BookWorm />
    </BrowserRouter>,
    document.getElementById("root")
);
