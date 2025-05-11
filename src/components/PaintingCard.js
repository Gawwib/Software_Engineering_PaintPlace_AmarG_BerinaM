// PaintingCard.js
import React from "react";
import "../styles/style.css";

const PaintingCard = ({ painting, handleAddToCart }) => {
  return (
    <div className="painting-card">
      <img src={painting.image} alt={painting.name} className="painting-image" />
      <h3>{painting.name}</h3>
      <p><strong>Artist:</strong> {painting.artist}</p>
      <p><strong>Price:</strong> ${painting.price}</p>
      <p><strong>Style:</strong> {painting.style}</p>
      <p><strong>Size:</strong> {painting.size}</p>
      {handleAddToCart && (
        <button className="cart-button" onClick={() => handleAddToCart(painting)}>
          Add to Cart
        </button>
      )}
    </div>
  );
};

export default PaintingCard;
