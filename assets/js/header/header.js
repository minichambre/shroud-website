import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import NavLink from "./navLink.js";
require('../../css/header.css');

class Header extends React.Component {
  constructor(props){
    super(props);
    this.state = {
    };
    this.getMessage = this.getMessage.bind(this);
    this.getNavLinks = this.getNavLinks.bind(this);
  }

  getMessage(){
    console.log(user);
    let message = ""
    if (user){
      message = "Welcome " + user;
      return (<a href="/logout"> <h2>{message} </h2> </a>);
    } else {
        return (<a href="/login"> <h2>Log in </h2> </a>);
    }


  }

  getNavLinks(){
    return (
      <div id="nav">
        <NavLink linkName="Home" linkUrl="/"/>
        <NavLink linkName="Apply" linkUrl="/apply"/>
        <NavLink linkName="Applications" linkUrl="/applications"/>
        <NavLink linkName="Forums" linkUrl="/Forums"/>
      </div>
    );
  }

  render(){
    return (
      <div id="react-header">
        {this.getNavLinks()}
        {this.getMessage()}
      </div>
    );

  }
}

ReactDOM.render(<Header/>, document.getElementById('header'));
