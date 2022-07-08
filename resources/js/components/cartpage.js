import React from "react";
import { useParams } from "react-router";
export default function CartPage() {
    let { id } = useParams();
    return (
        <>
            <h2>{id}</h2>
        </>
    );
}
