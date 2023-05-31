const userData = {
    x: null,
    y: null,
    radius: null,

    isXValid() {
        let validXValues = [-4, -3, -2, -1, 0, 1, 2, 3, 4]
        return this.x !== null && validXValues.includes(parseFloat(this.x))
    },
    isYValid() {
        let parsedY = parseFloat(this.y)
        console.log(-3 <= parsedY && parsedY <= 3)
        return -3 <= parsedY && parsedY <= 3
    },
    isRadiusValid() {
        let validRadiusValues = [1.0, 1.5, 2.0, 2.5, 3.0]
        return validRadiusValues.includes(parseFloat(this.radius))
    },
    isValid() {
        return this.isXValid() &&
            this.isYValid() &&
            this.isRadiusValid()
    }
}