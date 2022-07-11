import React from "react";
import Container from "react-bootstrap/Container";
import Navbar from "react-bootstrap/Navbar";
import axios from "axios";
import { useState, useEffect } from "react";
import Button from "react-bootstrap/Button";
import { Navigation, Autoplay } from "swiper";
import { Swiper, SwiperSlide } from "swiper/react";
import Cardd from "./cardd";

// Import Swiper styles
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import "swiper/css/scrollbar";

export default function GetOnSale() {
    const [books, setBooks] = useState([]);
    useEffect(() => {
        axios
            .get(`http://localhost:8000/api/books/get-on-sale`)
            .then((res) => {
                setBooks(res.data.data);
            })
            .catch((error) => console.log(error));
    }, []);
    return (
        <>
            <Navbar>
                <Container>
                    <h3>On Sale</h3>
                    <div className="justify-content-end">
                        <Button variant="primary">View all</Button>
                    </div>
                </Container>
            </Navbar>
            <div className="testSwiper">
                <Swiper
                    // install Swiper modules
                    spaceBetween={30}
                    slidesPerView={4}
                    navigation={true}
                    loop={true}
                    loopFillGroupWithBlank={true}
                    modules={[Navigation, Autoplay]}
                    autoplay={{
                        delay: 2500,
                        disableOnInteraction: false,
                    }}
                    className="dswiper"
                >
                    {books.map((book) => (
                        <SwiperSlide key={book.id}>
                            <Cardd book={book} />
                        </SwiperSlide>
                    ))}
                </Swiper>
            </div>
        </>
    );
}
