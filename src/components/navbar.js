import React, { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import "../styles/style.css";

const Navbar = () => {
  const [cartCount, setCartCount] = useState(0);

  useEffect(() => {
    const updateCartCount = () => {
      const cart = JSON.parse(localStorage.getItem("cart")) || [];
      setCartCount(cart.length);
    };

    updateCartCount();

    // ✅ Listen for cart updates triggered by Home.js
    window.addEventListener("cartUpdated", updateCartCount);

    return () => {
      window.removeEventListener("cartUpdated", updateCartCount);
    };
  }, []);

  return (
    <nav className="navbar">
      <div className="nav-brand">
        <Link to="/" className="nav-logo">🎨 PaintPlace</Link>
      </div>
      <div className="nav-links">
        <Link to="/" className="nav-link">Home</Link>
        <Link to="/cart" className="nav-link">
          🛒 Cart
          {cartCount > 0 && (
            <span className="cart-badge">{cartCount}</span>
          )}
        </Link>
        <Link to="/login" className="nav-link">Login</Link>
        <Link to="/signup" className="nav-link">Register</Link>
      </div>
    </nav>
  );
};

export default Navbar;
