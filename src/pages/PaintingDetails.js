// PaintingDetails.js - single painting detail view
import React, { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import { fetchPaintings } from "../services/paintingService";
import "../styles/style.css";

const PaintingDetails = () => {
  const { id } = useParams();
  const [painting, setPainting] = useState(null);

  useEffect(() => {
    const loadPainting = async () => {
      const data = await fetchPaintings();
      const selected = data.find((p) => p.id === parseInt(id));
      setPainting(selected);
    };

    loadPainting();
  }, [id]);

  if (!painting) {
    return <p className="loading">Loading painting details...</p>;
  }

  return (
    <div className="details-container">
      <img src={painting.image} alt={painting.name} className="details-image" />
      <div className="details-info">
        <h2>{painting.name}</h2>
        <p><strong>Artist:</strong> {painting.artist}</p>
        <p><strong>Price:</strong> ${painting.price}</p>
        <p><strong>Style:</strong> {painting.style}</p>
        <p><strong>Size:</strong> {painting.size}</p>
      </div>
    </div>
  );
};

export default PaintingDetails;
