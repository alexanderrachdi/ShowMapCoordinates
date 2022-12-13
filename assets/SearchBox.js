import React, { useState } from "react";
import {OutlinedInput} from "@material-ui/core";
import {Button} from "@material-ui/core";

const NOMINATIM_BASE_URL = "http://localhost:8000/api/v1/geolocation/";
const params = {
    q: ""
};

export default function SearchBox(props) {
    const { setSelectPosition } = props;
    const [searchText, setSearchText] = useState("");

    return (
        <div style={{ display: "flex", flexDirection: "column"}}>
            <div style={{ display: "flex" }}>
            <div style={{ flex:1 }}>
                <OutlinedInput style={{ width: "100%" }} value={searchText} onChange={(event) => {
                    setSearchText(event.target.value);
                }} />
            </div>
            <div style={{ display: "flex", alignItems: "center" }}>
                <Button variant="contained" color="primary" onClick={() => {
                    const params = {
                        q: searchText
                    };
                    const queryString = new URLSearchParams(params).toString();
                    const requestOptions = {
                        method: "GET",
                        redirect: "follow"
                    };
                    fetch(`${NOMINATIM_BASE_URL}${queryString}`, requestOptions)
                        .then((response) => {
                            if (response.status === 200) {
                               return response.text()
                            }
                            alert("Result not find");
                            throw new Error('result not find');
                        })
                        .then((result) => {
                            console.log(JSON.parse(result));
                            setSelectPosition(JSON.parse(result));
                        })
                        .catch((err) => console.log("err: ", err));
                }}>
                    Search
                </Button>
            </div>
            </div>
        </div>
    );
}