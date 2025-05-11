// src/pages/Cart.js
import React, { useEffect, useState } from "react";
import "../styles/style.css";

const Cart = () => {
  const [cartItems, setCartItems] = useState([]);

  useEffect(() => {
    const storedCart = JSON.parse(localStorage.getItem("cart")) || [];
    setCartItems(storedCart);
  }, []);

  const total = cartItems.reduce((sum, item) => sum + item.price, 0);

  const handleCheckout = (e) => {
    e.preventDefault();
    alert("✅ Payment accepted! Thank you for your order.");
    localStorage.removeItem("cart");
    setCartItems([]);
    window.dispatchEvent(new Event("cartUpdated"));
  };
  

  const handleRemoveFromCart = (indexToRemove) => {
    const updatedCart = cartItems.filter((_, i) => i !== indexToRemove);
    setCartItems(updatedCart);
    localStorage.setItem("cart", JSON.stringify(updatedCart));
  };
  

  return (
    <div className="home-container">
      <h2 className="page-title">Your Cart</h2>

      {cartItems.length === 0 ? (
        <p style={{ textAlign: "center" }}>Your cart is empty.</p>
      ) : (
        <>
          <div className="painting-list">
                {cartItems.map((item, index) => (
        <div key={index} className="painting-card">
            <img src={item.image} alt={item.name} className="painting-image" />
            <h3>{item.name}</h3>
            <p><strong>Artist:</strong> {item.artist}</p>
            <p><strong>Price:</strong> ${item.price}</p>
            <button className="remove-button" onClick={() => handleRemoveFromCart(index)}>
            Remove
            </button>
        </div>
        ))}

          </div>

          <div style={{ textAlign: "center", marginTop: "20px" }}>
            <h3>Total: ${total}</h3>
          </div>

          <div className="checkout-form">
            <h3>Checkout</h3>
            <form onSubmit={handleCheckout}>
              <label>Name on Card</label>
              <input type="text" required />

              <label>Card Number</label>
              <input
                type="text"
                maxLength="16"
                required
                placeholder="1234 5678 9012 3456"
              />

              <label>Expiry Date</label>
              <input type="text" placeholder="MM/YY" required />

              <label>CVV</label>
              <input type="password" maxLength="4" required />

              <button className="cart-button" type="submit">
                Confirm Payment
              </button>
            </form>
          </div>
        </>
      )}
    </div>
  );
};

export default Cart;
