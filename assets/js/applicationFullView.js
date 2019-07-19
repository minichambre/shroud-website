
import React, { Component } from 'react';
import ReactDOM from 'react-dom';
require('../css/header.css');

export default class applicationFullView extends React.Component {
  constructor(props){
    super(props);
    this.state = {
    };
  }

  componentDidMount(){

  }



  render(){
    return (
      <React.Fragment>
      <h3> Character Information </h3>
      <span className="largeName">
        {this.props.appDetails.character_main}
      </span>
      <span className="largeSpec">
        {this.props.appDetails.spec}
      </span>
      <span className="logLink">
        <a href={this.props.appDetails.log_link}> Log Link </a>
      </span>

      <h3> About </h3>
      <span className="about">
        {this.props.appDetails.about}
      </span>
      <h3> Experience </h3>
      <span className="experience">
        {this.props.appDetails.experience}
      </span>
      <h3> History </h3>
      <span className="history">
        {this.props.appDetails.history}
      </span>
      </React.Fragment>
    );
  }
}
