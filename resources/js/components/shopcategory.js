import Form from "react-bootstrap/Form";
import React from "react";
import axios from "axios";
import { useState, useEffect } from "react";

// Import Swiper styles
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import "swiper/css/scrollbar";

export default function Category(props) {
    const [categories, setCategoris] = useState([]);
    useEffect(() => {
        axios
            .get(`http://localhost:8000/api/categories`)
            .then((res) => {
                setCategoris(res.data.data);
            })
            .catch((error) => console.log(error));
    }, []);
    const handleCate = (event) => {
        props.parentCallback(event.target.value);
    };
    return (
        <>
            <div className="text-end mt-4 mb-4">
                <select
                    className="form-select w-50"
                    aria-label="Default select example"
                    onChange={handleCate}
                >
                    {categories.map((category) => (
                        <option value={category.id} key={category.id}>
                            {category.attributes.category_name}
                        </option>
                    ))}
                </select>
            </div>
        </>
    );
}
