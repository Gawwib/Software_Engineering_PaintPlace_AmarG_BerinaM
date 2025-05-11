// FilterBar.js - filter UI
import React from "react";
import "../styles/style.css";

const FilterBar = ({ filters, onFilterChange }) => {
  const handleChange = (e) => {
    const { name, value } = e.target;
    onFilterChange({ ...filters, [name]: value });
  };

  return (
    <div className="filter-bar">
      <select name="price" value={filters.price} onChange={handleChange}>
        <option value="">All Prices</option>
        <option value="low">Below $300</option>
        <option value="high">Above $300</option>
      </select>

      <select name="size" value={filters.size} onChange={handleChange}>
        <option value="">All Sizes</option>
        <option value="Small">Small</option>
        <option value="Medium">Medium</option>
        <option value="Large">Large</option>
      </select>

      <select name="style" value={filters.style} onChange={handleChange}>
        <option value="">All Styles</option>
        <option value="Expressionism">Expressionism</option>
        <option value="Symbolism">Renaissance</option>
        <option value="Baroque">Baroque</option>
        <option value="Renaissance">Renaissance</option>
        <option value="Post-Impressionism">Post-Impressionism</option>
      </select>
    </div>
  );
};

export default FilterBar;
