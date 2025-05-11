import React, { useEffect, useState } from "react";
import { fetchPaintings } from "../services/paintingService";
import PaintingCard from "../components/PaintingCard";
import FilterBar from "../components/FilterBar";
import "../styles/style.css";


const Home = () => {
  const [paintings, setPaintings] = useState([]);
  const [loading, setLoading] = useState(true);
  const [filters, setFilters] = useState({ price: "", size: "", style: "" });
  const [searchQuery, setSearchQuery] = useState("");

  useEffect(() => {
    const loadPaintings = async () => {
      const data = await fetchPaintings();
      setPaintings(data);
      setLoading(false);
    };
    loadPaintings();
  }, []);

  const [cart, setCart] = useState([]);
  const [message, setMessage] = useState(""); 
  
  const handleAddToCart = (painting) => {
    const alreadyInCart = cart.some((item) => item.id === painting.id);
  
    if (alreadyInCart) {
      setMessage(`⚠️ "${painting.name}" is already in your cart`);
      setTimeout(() => setMessage(""), 4000);
      return;
    }
  
    const updatedCart = [...cart, painting];
    setCart(updatedCart);
    localStorage.setItem("cart", JSON.stringify(updatedCart));
  
    setMessage(`✅ Added "${painting.name}" to cart!`);
    setTimeout(() => setMessage(""), 2000);
  
    // Notify navbar
    window.dispatchEvent(new Event("cartUpdated"));
  };
  
  
  

  const handleSearchChange = (e) => {
    setSearchQuery(e.target.value);
  };

  const applyFilters = (painting) => {
    const matchesSearch =
      painting.name.toLowerCase().includes(searchQuery.toLowerCase()) ||
      painting.artist.toLowerCase().includes(searchQuery.toLowerCase());

    if (!matchesSearch) return false;
    if (filters.price === "low" && painting.price > 300) return false;
    if (filters.price === "high" && painting.price <= 300) return false;
    if (filters.size && painting.size !== filters.size) return false;
    if (filters.style && painting.style !== filters.style) return false;
    return true;
  };

  return (
    <div className="home-container">
      <div className="intro-section">
        <h1>Welcome to PaintPlace 🎨</h1>
        <p>
          Discover and explore timeless masterpieces from legendary artists. Whether you're looking for a statement piece or simply browsing, PaintPlace brings the beauty of fine art to your fingertips.
        </p>
      </div>

      <h2 className="page-title">Browse Paintings</h2>

      <input
        type="text"
        placeholder="Search by name or artist..."
        value={searchQuery}
        onChange={handleSearchChange}
        className="search-input"
      />

      <FilterBar filters={filters} onFilterChange={setFilters} />
      {message && (
        <p style={{ textAlign: "center", color: "#efcb7b", marginBottom: "15px" }}>
          {message}
        </p>
      )}


      {loading ? (
        <p className="loading">Loading...</p>
      ) : (
        <div className="painting-list">
          {paintings.filter(applyFilters).map((painting) => (
            <PaintingCard
            key={painting.id}
            painting={painting}
            handleAddToCart={handleAddToCart}
          />
          
          ))}
        </div>
      )}

      <div className="contact-section">
        <h3>Contact Us</h3>
        <p>Email: support@paintplace.com</p>
        <p>Phone: +387 61 111 111</p>
        <p>Follow us on Instagram @paintplace or use the chat widget on the bottom right!</p>
      </div>

      <footer className="footer">
        &copy; {new Date().getFullYear()} PaintPlace. All rights reserved.
      </footer>
    </div>
  );
};

export default Home;
