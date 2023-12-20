import React from 'react'
import "./admin.scss";

import Users from "../../assets/icon/users.svg";
import Cards from "../../assets/icon/cards.svg";

export default function admin() {


  return (
    <div className="adminPage">
        <h2>Tableau de bord</h2>
        <div className="container">
          <div className="tabs">
            <div className="tab users">
              <img src={Cards} alt="cards" />
            </div>
            <div className="tab cards">
              <img src={Users} alt="users" />
            </div>
          </div>
          <div className="content">
            
          </div>
        </div>
    </div>
  )
}
