import React from "react";
import { useState, useEffect } from "react";
import Button from "react-bootstrap/Button";
import Card from "react-bootstrap/Card";
import { Navigation, Pagination, Scrollbar, A11y } from "swiper";
import { Swiper, SwiperSlide } from "swiper/react";

// Import Swiper styles
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import "swiper/css/scrollbar";

export default function GetOnSale() {
    const [books, setBooks] = useState([]);

    useEffect(() => {
        fetch("http://localhost:8000/api/books/get-on-sale")
            .then((res) => res.json())
            .then((result) => {
                setBooks(result.data);
            });
    }, []);
    return (
        <>
            <Swiper
                // install Swiper modules
                modules={[Navigation, Pagination, Scrollbar, A11y]}
                spaceBetween={50}
                slidesPerView={3}
                navigation
                pagination={{ clickable: true }}
                scrollbar={{ draggable: true }}
                onSwiper={(swiper) => console.log(swiper)}
                onSlideChange={() => console.log("slide change")}
            >
                {books.map((book) => (
                    <SwiperSlide key={book.id}>
                        <Card className="dcard">
                            <img
                                className="dimg"
                                src={`http://localhost:8000/images/${book.attributes.book_cover}.jpg`}
                                alt=""
                            />
                            <Card.Body>
                                <p>{book.attributes.book_title}</p>
                                <p>Cart Text</p>
                                <Button variant="primary">Detail</Button>
                            </Card.Body>
                        </Card>
                    </SwiperSlide>
                ))}
            </Swiper>
        </>
    );
}
