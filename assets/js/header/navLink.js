import React, { Component } from 'react';
import ReactDOM from 'react-dom';
require('../../css/header.css');

class NavLink extends React.Component {
  constructor(props){
    super(props);
    this.state = {
    };
    this.getActiveBar = this.getActiveBar.bind(this);
  }

  getActiveBar(){
    let color = "white";
    if (window.location.pathname === "/" && this.props.linkUrl === "/"){
      color = "#ea7f25";
    } else if (window.location.pathname.includes(this.props.linkUrl) && this.props.linkUrl != "/"){
      color = "#ea7f25";
    }
    return (
      <span id="nav-status" style={{background:color}}></span>
    );
  }

  render(){
    return (
      <div id="nav-link-container">
        <div class="nav-links">
          <a href={this.props.linkUrl}> {this.props.linkName} </a>
        </div>
        {this.getActiveBar()}

      </div>
    );

  }
}

export default NavLink
