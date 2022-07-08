import React from "react";

export default function ShopHeader(props) {
    const handleOnSale = (event) => {
        props.parentCallback(event.target.value);
    };
    return (
        <>
            <div className="mt-4 mb-4">
                <p>Sort</p>
                <select
                    className="form-select w-50"
                    aria-label="Default select example"
                    onChange={handleOnSale}
                >
                    <option value="1" selected>
                        Sort by on sale
                    </option>
                    <option value="2">Sort by popular</option>
                    <option value="3">Sort by price low to high</option>
                    <option value="4">Sort by price high to low</option>
                </select>
            </div>
        </>
    );
}
