
import React, { Component } from 'react';
import ReactDOM from 'react-dom';
require('../css/header.css');

export default class SmallApplication extends React.Component {
  constructor(props){
    super(props);
    this.state = {
    };
    this.clicked = this.clicked.bind(this);
    this.myRef = React.createRef();
  }

  componentDidMount(){
    console.log(this.props.index);
    let dateCreated = this.props.application.date_created;
    let currentTime = Date.now();
    console.log("current " , currentTime);
    console.log("created " , dateCreated);
    console.log("minus ",currentTime - dateCreated);
    this.setState({
      app: this.props.application,
      timeSince: this.timeSince(Math.round(currentTime - (dateCreated*1000))),
      loaded:true})
  }

  timeSince(ms){
    let msPerMinute = 60 * 1000;
    let msPerHour = msPerMinute * 60;
    let msPerDay = msPerHour * 24;
    let msPerMonth = msPerDay * 30;
    let msPerYear = msPerDay * 365;
    if (ms < msPerMinute) {
         return Math.round(ms/1000) + ' seconds ago';
    }

    else if (ms < msPerHour) {
         return Math.round(ms/msPerMinute) + ' minutes ago';
    }

    else if (ms < msPerDay ) {
         return Math.round(ms/msPerHour ) + ' hours ago';
    }

    else if (ms < msPerMonth) {
        return 'approximately ' + Math.round(ms/msPerDay) + ' days ago';
    }

    else if (ms < msPerYear) {
        return 'approximately ' + Math.round(ms/msPerMonth) + ' months ago';
    }

    else {
        return 'approximately ' + Math.round(ms/msPerYear ) + ' years ago';
    }
  }

  clicked(){
    this.props.handleSmallAppClick(this.props.index);
    if (document.querySelector(".activeApp")){
      document.querySelectorAll(".activeApp").forEach((element) => {
        element.classList.remove('activeApp');
      })
    }

    this.myRef.current.classList.add('activeApp');
  }


  render(){
    return (
      <React.Fragment>
      {this.state.loaded &&
        <div ref={this.myRef} className="smallApp" onClick={this.clicked}>
          <img src="https://via.placeholder.com/100/aaaaaa/FFFFFF/?text=IPaddress.net"/>
          <div className="textContainer">
            <span className="smallName"> {this.state.app.character_main} </span>
            <span className="smallSpec"> {this.state.app.spec} </span>
            <span className="smallApplied"> {this.state.timeSince} </span>
          </div>
        </div>
      }
      </React.Fragment>
    );
  }
}
