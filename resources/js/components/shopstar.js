import Form from "react-bootstrap/Form";
import React from "react";

// Import Swiper styles
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import "swiper/css/scrollbar";

export default function Star() {
    return (
        <>
            <div className="justify-content-end">
                <div className="dropdown">
                    <button
                        className="btn btn-danger dropdown-toggle"
                        type="button"
                        id="dropdownMenuButton1"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        Dropdown button
                    </button>
                    <ul
                        className="dropdown-menu"
                        aria-labelledby="dropdownMenuButton1"
                    >
                        <li>
                            <a className="dropdown-item" href="#">
                                Action
                            </a>
                        </li>
                        <li>
                            <a className="dropdown-item" href="#">
                                Another action
                            </a>
                        </li>
                        <li>
                            <a className="dropdown-item" href="#">
                                Something else here
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </>
    );
}
