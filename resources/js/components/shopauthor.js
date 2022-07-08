import React from "react";
import axios from "axios";
import { useState, useEffect } from "react";

// Import Swiper styles
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import "swiper/css/scrollbar";

export default function Author(props) {
    const [authors, setAuthors] = useState([]);
    useEffect(() => {
        axios
            .get(`http://localhost:8000/api/authors`)
            .then((res) => {
                setAuthors(res.data.data);
            })
            .catch((error) => console.log(error));
    }, []);
    const handleAuthor = (event) => {
        props.parentCallback(event.target.value);
    };
    return (
        <>
            <div className="text-end mt-4 mb-4">
                <select
                    className="form-select w-50"
                    aria-label="Default select example"
                    onChange={handleAuthor}
                >
                    {authors.map((author) => (
                        <option value={author.id} key={author.id}>
                            {author.attributes.author_name}
                        </option>
                    ))}
                </select>
            </div>
        </>
    );
}
