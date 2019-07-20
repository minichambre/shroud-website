
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
    let dateCreated = this.props.application.date_created;
    let currentTime = Date.now();
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

  getImage(){
    switch (this.state.app.class_type){
      case "Druid":
        return "/images/class-icons/GameIcon-class-druid-vector.png"
      case "Warlock":
        return "/images/class-icons/GameIcon-class-warlock-vector.png"
      case "Rogue":
        return "/images/class-icons/GameIcon-class-rogue-vector.png"
      case "Priest":
        return "/images/class-icons/GameIcon-class-priest-vector.png"
      case "Paladin":
        return "/images/class-icons/GameIcon-class-paladin-vector.png"
      case "Mage":
        return "/images/class-icons/GameIcon-class-mage-vector.png"
      case "Shaman":
        return "/images/class-icons/GameIcon-class-shaman-vector.png"
      case "Monk":
        return "/images/class-icons/GameIcon-class-monk-vector.png"
      case "Death Knight":
        return "/images/class-icons/GameIcon-class-death-knight-vector.png"
      case "Demon Hunter":
        return "/images/class-icons/GameIcon-class-demon-hunter-vector.png"
      case "Hunter":
        return "/images/class-icons/GameIcon-class-hunter-vector.png"
      case "Warrior":
        return "/images/class-icons/GameIcon-class-warrior-vector.png"
    }
  }


  render(){
    return (
      <React.Fragment>
      {this.state.loaded &&
        <div ref={this.myRef} className="smallApp" onClick={this.clicked}>
          <img src={this.getImage()}/>
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
