import React from "react";
import { Link } from "react-router-dom";
import "./dashboard.scss";

export default function dashboard() {
  return (
    <div className="dashboardPage">
      <div className="top">
        <h2>Dashboard</h2>
        <Link to="/creation">Créer une carte</Link>
      </div>
    </div>
  );
}
