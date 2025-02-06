package com.marieteam.demo.controller;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping(path = "reservation")
public class ReservationController {
    @GetMapping(path = "string")

    public String getString() {
        return "Hello World";
    }
}
