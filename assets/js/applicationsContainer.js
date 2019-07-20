
import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import SmallApplication from './smallApplication.js'
import ApplicationFullView from './applicationFullView'

class ApplicationsContainer extends React.Component {
  constructor(props){
    super(props);
    this.state = {
      showIndex:0
    };
    this.handleSmallAppClick = this.handleSmallAppClick.bind(this);
    this.backButton = this.backButton.bind(this);
  }

  componentDidMount(){
    fetch("/api/applications/get")
      .then(res => res.json())
      .then (
        (result) => {
          this.setState({
            isLoaded:true,
            listOfApplications: result.items,
            error:false
          });
          console.log("okay!");
          console.log(result.items);
        },
        (error) => {
          this.setState({
            isLoaded:true,
            error:true
          })
          console.log("oh boy");
          console.log(error);
        }
      )
  }

  handleSmallAppClick(index){
    console.log("Parent got: ", index);
    this.setState({showIndex:index, showFullView:true});

  }

  backButton() {
    console.log("hi");
    this.setState({showFullView: false});
  }


  render(){
    return (
      <div className="applications-container">
        <h1> Applications </h1>
        <div className="applications-controlPanel">
        <input className="searchApp" placeholder="Search Applications"/>
        </div>
        <div className="wrapper" style={{left:this.state.showFullView ? "-105%" : ""}}>
          <div className="list">
            {this.state.isLoaded && this.state.listOfApplications.map((applicationDetails,i) =>
              <SmallApplication
                application={applicationDetails}
                index={i}
                handleSmallAppClick={this.handleSmallAppClick}
              />
            )}
          </div>

          <div className="fullView">
          {this.state.isLoaded &&
            <ApplicationFullView
              appDetails={this.state.listOfApplications[this.state.showIndex]}
              back={this.backButton}
            />
          }
          </div>
        </div>

      </div>
    );

  }
}

ReactDOM.render(<ApplicationsContainer/>, document.getElementById('applications-root'));
