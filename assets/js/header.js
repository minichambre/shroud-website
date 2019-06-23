import React, { Component } from 'react';
import ReactDOM from 'react-dom';
require('../css/header.css');

class Header extends React.Component {
  constructor(props){
    super(props);
    this.state = {
    };
    this.getMessage = this.getMessage.bind(this);
    this.getNavLinks = this.getNavLinks.bind(this);
  }

  getMessage(){
    let message = "hi" + user;
    return (<h1> {message} </h1>);
  }

  getNavLinks(){
    return (
      <div id="nav-links-container">
        <a class="nav-links" href="#"> link </a>
        <a class="nav-links" href="#"> link </a>
        <a class="nav-links" href="#"> link </a>
        <a class="nav-links" href="#"> link </a>
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
